document.addEventListener('DOMContentLoaded', function() {

    // --- ШАГ 1: Находим все DOM-элементы СРАЗУ ---
    console.log("DOM загружен. Ищем элементы управления...");
    const currentYearDisplay = document.getElementById('current-year-display');
    const sliderElement = document.getElementById('timeline-slider');
    const playPauseButton = document.getElementById('play-pause-button');
    const currentDateElement = document.getElementById('current-date');
    const mapContainer = document.getElementById('map');

    if (!sliderElement || !playPauseButton || !currentDateElement || !mapContainer) {
        console.error("Критическая ошибка: один или несколько элементов для карты (слайдер, кнопка, карта) не найдены на странице. Скрипт остановлен.");
        return;
    }
    console.log("Элементы управления найдены.");

    // --- ШАГ 2: Инициализируем карту и слайдер ---
    console.log("Инициализация карты и слайдера...");
    const myMap = L.map(mapContainer).setView([55.0, 40.0], 4);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(myMap);
    const featureGroup = L.layerGroup().addTo(myMap);

    const startDate = new Date('1941-06-22').getTime();
    const endDate = new Date('1945-05-09').getTime();

    const timelineSlider = noUiSlider.create(sliderElement, {
        start: startDate,
        range: { 'min': startDate, 'max': endDate },
        step: 24 * 60 * 60 * 1000,
        format: { to: value => Math.round(value), from: value => Number(value) }
    });

    // --- ШАГ 3: Объявляем переменные и функции ---
    let allData = null;
    let animationInterval = null;
    let isPlaying = false;

    // Находим иконки внутри кнопки Play/Pause
    const playIcon = playPauseButton.querySelector('.icon-play');
    const pauseIcon = playPauseButton.querySelector('.icon-pause');

    const ussrPolygonOptions = { color: '#CC3333', weight: 2, fillColor: '#CC3333', fillOpacity: 0.5 };
    const axisPolygonOptions = { color: '#445566', weight: 2, fillColor: '#445566', fillOpacity: 0.5 };

    function updateMapState(currentTimestamp) {
        if (!allData) return;
        featureGroup.clearLayers();
        let currentFrontline = null;
        for (let i = allData.frontlines.length - 1; i >= 0; i--) {
            if (allData.frontlines[i].event_date_ts <= currentTimestamp) {
                currentFrontline = allData.frontlines[i];
                break;
            }
        }
        if (currentFrontline) {
            L.polygon(currentFrontline.ussr_territory_coords, ussrPolygonOptions).addTo(featureGroup);
            L.polygon(currentFrontline.axis_territory_coords, axisPolygonOptions).addTo(featureGroup);
        }
        const sliderYear = new Date(currentTimestamp).getFullYear();
        allData.battles.forEach(battle => {
            const battleStartYear = new Date(battle.start_date_ts).getFullYear();
            const battleEndYear = new Date(battle.end_date_ts).getFullYear();
            if (sliderYear >= battleStartYear && sliderYear <= battleEndYear) {
                const marker = L.marker([battle.latitude, battle.longitude]);
                const popupContent = `<div class="battle-balloon"><h3>${battle.name}</h3><p><strong>Даты:</strong> ${new Date(battle.start_date).toLocaleDateString('ru-RU')} - ${new Date(battle.end_date).toLocaleDateString('ru-RU')}</p><p>${battle.description}</p><a href="${baseUrl}/battle/${battle.slug}" target="_blank">Подробнее...</a></div>`;
                marker.bindPopup(popupContent);
                marker.bindTooltip(battle.name);
                marker.addTo(featureGroup);
            }
        });
    }

    function startAnimation() {
        console.log("Запуск анимации...");
        stopAnimation();

        animationInterval = setInterval(() => {
            let currentValue = timelineSlider.get();
            let nextValue = currentValue + (24 * 60 * 60 * 1000 * 7);

            if (nextValue >= endDate) {
                timelineSlider.set(endDate);
                stopAnimation();
                isPlaying = false;
                // Сбрасываем иконку на "Play" при завершении
                if(playIcon) playIcon.style.display = 'block';
                if(pauseIcon) pauseIcon.style.display = 'none';
                console.log("Анимация завершена.");
            } else {
                timelineSlider.set(nextValue);
            }
        }, 100);
    }

    function stopAnimation() {
        if (animationInterval) {
            clearInterval(animationInterval);
            animationInterval = null;
            console.log("Анимация остановлена.");
        }
    }

    // --- ШАГ 4: Назначаем обработчики событий ---
    console.log("Назначаем обработчики событий...");
    timelineSlider.on('update', (values) => {
        const currentTimestamp = values[0];
        updateMapState(currentTimestamp);
        currentDateElement.textContent = new Date(currentTimestamp).toLocaleDateString('ru-RU');
        if (currentYearDisplay) {
            currentYearDisplay.textContent = new Date(currentTimestamp).getFullYear();
        }
    });

    playPauseButton.addEventListener('click', () => {
        isPlaying = !isPlaying;
        if (isPlaying) {
            // Показываем иконку паузы, скрываем иконку play
            if(playIcon) playIcon.style.display = 'none';
            if(pauseIcon) pauseIcon.style.display = 'block';
            startAnimation();
        } else {
            // Показываем иконку play, скрываем иконку паузы
            if(playIcon) playIcon.style.display = 'block';
            if(pauseIcon) pauseIcon.style.display = 'none';
            stopAnimation();
        }
    });

    // --- ШАГ 5: Загружаем данные ---
    console.log("Запрашиваем данные с сервера...");
    fetch(baseUrl + '/map/get-data')
        .then(response => response.json())
        .then(data => {
            console.log("Данные успешно получены:", data);
            allData = data;
            allData.battles.forEach(b => {
                b.start_date_ts = new Date(b.start_date).getTime();
                b.end_date_ts = new Date(b.end_date).getTime();
            });
            allData.frontlines.forEach(f => {
                f.event_date_ts = new Date(f.event_date).getTime();
            });

            console.log("Выполняем первое обновление карты...");
            timelineSlider.set(startDate);
        })
        .catch(error => console.error("Критическая ошибка загрузки данных:", error));
});