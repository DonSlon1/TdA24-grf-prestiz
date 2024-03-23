function removeQueryString() {
    // Vytvoření nového URL bez query string
    let url = window.location.protocol + "//" + window.location.host + window.location.pathname;

    // Použití history API pro změnu URL bez načtení stránky
    window.history.replaceState({path: url}, '', url);
}

// Volání funkce
removeQueryString();

function saveForm() {
    // Uložit lokality
    const locationInputs: NodeListOf<HTMLInputElement> = document.querySelectorAll('input[name="location"]:checked');
    const locations: any[] = [];
    locationInputs.forEach(function (input) {
        locations.push(input.value);
    });
    localStorage.setItem('locations', JSON.stringify(locations));

    // Uložit ceny
    // @ts-ignore
    let minPrice = document.getElementById('min-price').value;
    // @ts-ignore
    let maxPrice = document.getElementById('max-price').value;

    //change min and max price if min price is bigger than max price
    if (minPrice * 1 > maxPrice * 1) {
        let temp = minPrice;
        minPrice = maxPrice;
        maxPrice = temp;
    }
    localStorage.setItem('minPrice', minPrice);

    localStorage.setItem('maxPrice', maxPrice);

    const priceSort = $('#sort-price-input')[0] as HTMLInputElement;
    localStorage.setItem('priceSort', priceSort.value);

    // Uložit štítky
    const tagsInputs: NodeListOf<HTMLInputElement> = document.querySelectorAll('input[name="tags"]:checked');
    const tags: any[] = [];
    tagsInputs.forEach(function (input) {
        tags.push(input.value);
    });
    localStorage.setItem('tags', JSON.stringify(tags));
}

document.getElementById('lecturer-form')?.addEventListener('submit', function () {
    saveForm();
});

// Při načítání stránky
document.addEventListener('DOMContentLoaded', function () {
    // projde vsechny taggy a pokud je nejaky zaskrtunuty tak neprovede zbytek funkce a odchekne vsechny lokality a ceny a odskrtne vsechny tagy kromne toho zaskrtnuteho
    const htmlElement = document.getElementById('lecturer-form') as HTMLFormElement | null;
    htmlElement?.reset();

    const tagsInputs: NodeListOf<HTMLInputElement> = document.querySelectorAll('input[name="tags"][data-checked="true"]');
    if (tagsInputs.length > 0) {
        for (let i = 0; i < tagsInputs.length; i++) {
            tagsInputs[i].checked = true;
        }
        const locationInputs: NodeListOf<HTMLInputElement> = document.querySelectorAll('input[name="location"]');
        locationInputs.forEach(function (input) {
            input.checked = false;
        });

        const $slider = $("#price-slider-range");
        // @ts-ignore
        document.getElementById('min-price').value = $slider.data().min;
        // @ts-ignore
        document.getElementById('max-price').value = $slider.data().max;
        saveForm();

        return;
    }

    // Nastavit lokality
    // @ts-ignore
    const savedLocations = JSON.parse(localStorage.getItem('locations')) || [];
    savedLocations.forEach(function (location: string) {
        const input = document.querySelector('input[name="location"][value="' + location + '"]') as HTMLInputElement | null;
        if (input) {
            input.checked = true;
        }
    });

    const savedPriceSort = localStorage.getItem('priceSort');
    const priceSort = $('#sort-price-input')[0] as HTMLInputElement;
    if (savedPriceSort) {
        priceSort.value = savedPriceSort;
    } else {
        priceSort.value = 'asc';
    }
    // Nastavit ceny
    const savedMinPrice = localStorage.getItem('minPrice');
    const $slider = $("#price-slider-range");
    // @ts-ignore
    if (savedMinPrice && parseInt($slider.data().min, 10) < parseInt(savedMinPrice, 10) || parseInt($slider.data().max, 10) < parseInt(savedMinPrice, 10)) {
        // @ts-ignore
        document.getElementById('min-price').value = savedMinPrice;
    } else {
        localStorage.setItem('minPrice', $slider.data().min);
        document.getElementById('min-price')?.setAttribute('value', $slider.data().min);
    }

    const savedMaxPrice = localStorage.getItem('maxPrice');
    if (savedMaxPrice && parseInt($slider.data().max, 10) > parseInt(savedMaxPrice, 10)) {
        // @ts-ignore
        document.getElementById('max-price').value = savedMaxPrice;
    } else {
        localStorage.setItem('maxPrice', $slider.data().max);
        document.getElementById('max-price')?.setAttribute('value', $slider.data().max);
    }

    // Nastavit štítky
    // @ts-ignore
    const savedTags = JSON.parse(localStorage.getItem('tags')) || [];
    savedTags.forEach(function (tag: string) {
        const input = document.querySelector('input[name="tags"][value="' + tag + '"]') as HTMLInputElement | null;
        if (input) {
            input.checked = true;
        }
    });
    const form = document.getElementById('lecturer-form') as HTMLFormElement | null;
    if (form == null) {
        return;
    }
    submitForm();
});
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('lecturer-form');
    if (form == null) {
        return;
    }
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        submitForm()
    });
});
const submitForm = async () => {
    let formData = $('#lecturer-form').serializeArray();
    let tags: string[] = [];
    let locations: string[] = [];
    let minPrice = "0";
    let maxPrice = "0";
    for (let i = 0; i < formData.length; i++) {
        if (formData[i].name === 'tags') {
            tags.push(formData[i].value);
        } else if (formData[i].name === 'location') {
            locations.push(formData[i].value);
        } else if (formData[i].name === 'min-price') {
            minPrice = formData[i].value;
        } else if (formData[i].name === 'max-price') {
            maxPrice = formData[i].value;
        }
    }
    const paramsU = new URLSearchParams(window.location.search);
    const param1 = parseInt(paramsU.get('page') ?? '1');
    const sortPrice = $('#sort-price-input')[0] as HTMLInputElement;
    const params = {
        where: {
            tags: tags,
            location: locations,
            min: minPrice,
            max: maxPrice,
            page: param1,
            priceSort: sortPrice.value
        },
    };
    console.log(params)
    let urlParams = Object.keys(params.where).map(key => {
        if (key == 'page') {
            return `page=${params.where[key]}`;
        }
        if (key == 'priceSort') {
            return `priceSort=${params.where[key]}`;
        }
        // @ts-ignore
        if (Array.isArray(params.where[key])) {
            // Pro pole vytvoříme řetězec s více parametry
            // @ts-ignore
            return params.where[key].map(value => `where[${key}][]=${encodeURIComponent(value)}`).join('&');
        } else {
            // Pro jednotlivé hodnoty vytvoříme jednoduchý parametr
            // @ts-ignore
            return `where[${key}]=${encodeURIComponent(params.where[key])}`;
        }
    }).join('&');
    getLecturer(urlParams)
        .then((r) => {
            return r.json()
        })
        .then((response: { html: string, paging: string }) => {
            console.log(response)
            const lecturersContainer = document.getElementById('lecturer');
            const pagingContainer = $('#paging-container');
            if (lecturersContainer == null || pagingContainer == null) {
                return;
            }
            // @ts-ignore
            lecturersContainer.innerHTML = response.html;
            pagingContainer.html(response.paging);
            initPaging();
            toggleDarkMode(true);
        });
}

const initPaging = () => {
    const $paging = $('#pagination');
    const $pagingButtons = $('#pagination button');

    $pagingButtons.on('click', function (event) {
        event.preventDefault();
        const page = $(this).data('page');
        const params = new URLSearchParams(window.location.search);
        let currentPage = parseInt(params.get('page') ?? '1');
        const maxPage = parseInt($paging.data('maxpage') ?? '1');

        if (page == 'prev') {
            currentPage = Math.max(currentPage - 1, 1);
        } else if (page == 'next') {
            currentPage = Math.min(currentPage + 1, maxPage);
        } else {
            currentPage = parseInt(page);
        }

        params.set('page', currentPage.toString());
        history.pushState(null, '', '?' + params.toString());
        var container = $('html, body'); // Adjust this depending on which element contains the scrollbar

        // The div you want to scroll to
        var divToScrollTo = $('#lecturer');

        // Calculate the top offset position of the div
        //@ts-ignore
        var scrollToPosition = divToScrollTo.offset().top - 100;

        // Animate the scroll to the top of the div
        container.animate({
            scrollTop: scrollToPosition
        }, 1000); // Duration in milliseconds (1000 ms = 1 second), adjust as necessary
        submitForm();

        // Disable or enable previous and next buttons based on the current page
        $('#prev').prop('disabled', currentPage === 1);
        $('#next').prop('disabled', currentPage === maxPage);
    });

    // Initial button states setup
    const currentPage = parseInt(new URLSearchParams(window.location.search).get('page') ?? '1');
    const maxPage = parseInt($paging.data('maxpage') ?? '1');
    $('#prev').prop('disabled', currentPage === 1);
    $('#next').prop('disabled', currentPage === maxPage);
};


const getLecturer = async (data: string) => {
    return await fetch('/api/lecturers/cards/?' + data);
}

$(function () {
    priceSortIcon();
    const $slider = $("#price-slider-range");
    const $minPrice = $("#min-price");
    const $maxPrice = $("#max-price");

    const maxPrice = parseInt($slider.data().max, 10);
    const minPrice = parseInt($slider.data().min, 10);

    let minPriceValue = parseInt(<string>$minPrice.val(), 10);

    if (isNaN(minPriceValue)) {
        minPriceValue = isNaN(minPrice) ? 0 : minPrice; // Pokud ani jedna není číslo, použije se 0
    }
    if (minPriceValue < minPrice || minPriceValue > maxPrice) {
        minPriceValue = minPrice;
        localStorage.setItem('minPrice', minPriceValue.toString());
    }
    let maxPriceValue = parseInt(<string>$maxPrice.val(), 10);

    if (isNaN(maxPriceValue)) {
        maxPriceValue = isNaN(maxPrice) ? 0 : maxPrice; // Pokud ani jedna není číslo, použije se 0
    }
    if (maxPriceValue > maxPrice || maxPriceValue < minPrice) {
        maxPriceValue = maxPrice;
        localStorage.setItem('maxPrice', maxPriceValue.toString());
    }
    $slider.slider({
        range: true,
        min: minPrice,
        max: maxPrice, // Maximální hodnota ceny
        values: [minPriceValue, maxPriceValue], // Výchozí hodnoty
        create: function () {
            // Nastavení počátečních hodnot inputů
            $minPrice.val(minPriceValue);
            $maxPrice.val(maxPriceValue);
            const handles = $(this).find('.ui-slider-handle');
            if (minPriceValue === maxPriceValue && minPriceValue === minPrice) {
                $(handles[1]).css('left', '0%');
                $(handles[0]).css('left', '100%');
            }
        },

        slide: function (event, ui) {
            // Aktualizace inputů při posunu slideru
            if (ui.values?.length === 2) {
                $minPrice.val(ui.values[0]);
                $maxPrice.val(ui.values[1]);
            }
        }
    });

    // Funkce pro aktualizaci slideru po změně hodnoty v inputu
    function updateSlider() {
        let minVal = parseInt(<string>$minPrice.val(), 10);
        let maxVal = parseInt(<string>$maxPrice.val(), 10);
        if (minVal > maxVal) {
            minVal = maxVal;
            $minPrice.val(minVal);
        }
        if (maxVal < minVal) {
            maxVal = minVal;
            $maxPrice.val(maxVal);
        }
        // Zkontrolujte, zda jsou hodnoty v platném rozsahu a aktualizujte slider
        if (!isNaN(minVal) && !isNaN(maxVal) && minVal <= maxVal) {
            $slider.slider("values", [minVal, maxVal]);
        }
    }

    // Event listenery pro změnu hodnot v inputech
    $minPrice.on('change', updateSlider);
    $minPrice.on('change', function () {
        if (parseInt(<string>$(this).val(), 10) > parseInt(<string>$maxPrice.val(), 10)) {
            // @ts-ignore
            $(this).val($maxPrice.val());
        }
        if (parseInt(<string>$(this).val(), 10) < parseInt($slider.data().min, 10)) {
            // @ts-ignore
            $(this).val($slider.data().min);
        }
    });
    $minPrice.on('input', function () {
        // @ts-ignore
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });
    $maxPrice.on('change', function () {
        if (parseInt(<string>$(this).val(), 10) < parseInt(<string>$minPrice.val(), 10)) {
            // @ts-ignore
            $(this).val($minPrice.val());
        }
        if (parseInt(<string>$(this).val(), 10) > parseInt($slider.data().max, 10)) {
            // @ts-ignore
            $(this).val($slider.data().max);
        }
    })
    $maxPrice.on('input', function () {
        // @ts-ignore
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });
    $maxPrice.on('change', updateSlider);
});

// Function for reseting filters
function resetFilters() {

    const priceSort = $('#price-sort');
    if (priceSort.length !== 0) {
        initPriceSort(priceSort)
    }
    const resetButton = document.getElementById('reset-button');

    const tags = document.querySelectorAll('#tag-field .tag-checkbox');
    const locations = document.querySelectorAll('#location-field .checkbox');

    const minPrice = document.getElementById('min-price') as HTMLInputElement;
    const minPriceValue = minPrice.getAttribute('data-minprice') as string;

    const maxPrice = document.getElementById('max-price') as HTMLInputElement;
    const maxPriceValue = maxPrice.getAttribute('data-maxprice') as string;

    const $slider = $("#price-slider-range");

    if (resetButton) { // Check if the button exists
        resetButton.addEventListener('click', () => {
            console.log('reset');
            tags.forEach(tag => {
                (tag as HTMLInputElement).checked = false;
            });

            locations.forEach(location => {
                (location as HTMLInputElement).checked = false;
            });

            minPrice.value = minPriceValue;
            maxPrice.value = maxPriceValue;

            $slider.slider('values', [parseInt(minPriceValue), parseInt(maxPriceValue)]);

        });
    }

    saveForm();
    submitForm();
}

function priceSortIcon() {
    const priceSortBtn = document.getElementById('price-sort') as HTMLButtonElement;

    if (priceSortBtn == null) {
        return;
    }

    const priceSortIcon = priceSortBtn.querySelector('img') as HTMLImageElement;

    const priceSortText = priceSortBtn.querySelector('p') as HTMLSpanElement;

    priceSortBtn.addEventListener('click', function () {
        if (priceSortIcon.src.includes('up')) {
            priceSortIcon.src = priceSortIcon.src.replace('up', 'down');
            priceSortText.textContent = 'Cena: sestupně';
        } else {
            priceSortIcon.src = priceSortIcon.src.replace('down', 'up');
            priceSortText.textContent = 'Cena: vzestupně';
        }
    });

}

function initPriceSort(element: JQuery<HTMLElement>) {
    const priceSortBtn = document.getElementById('price-sort') as HTMLButtonElement;

    if (priceSortBtn == null) {
        return;
    }

    const priceSortIcon = priceSortBtn.querySelector('img') as HTMLImageElement;

    const priceSortText = priceSortBtn.querySelector('p') as HTMLSpanElement

    const input = $('#sort-price-input')[0] as HTMLInputElement;
    if (localStorage.getItem('priceSort') === 'asc') {
        input.value = 'asc';
        element.addClass('asc');
        element.removeClass('desc');
        priceSortIcon.src = priceSortIcon.src.replace('down', 'up');
        priceSortText.textContent = 'Cena: vzestupně';
    } else {
        input.value = 'desc';
        element.removeClass('asc');
        element.addClass('desc');
        priceSortIcon.src = priceSortIcon.src.replace('up', 'down');
        priceSortText.textContent = 'Cena: sestupně';
    }
    element.on('click', function (event) {
        const input = $('#sort-price-input')[0] as HTMLInputElement;
        event.preventDefault();
        if (input.value === 'asc') {
            input.value = 'desc';
        } else {
            input.value = 'asc';
        }
        submitForm();
        saveForm();
    });
}

document.addEventListener('DOMContentLoaded', function () {
    resetFilters();// Call the resetFilters function to initialize it
});