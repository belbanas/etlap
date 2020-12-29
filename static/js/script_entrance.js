const DOM = {
    init: () => {
        DOM.fetchData();
    },
    foodList: {
        soupHU: "",
        soupEN: "",
        soupUA: "",
        soupKR: "",
        foodHU: "",
        foodEN: "",
        foodUA: "",
        foodKR: "",
    },
    closeList: {
        closedHU: "ZÁRVA",
        closedUA: "ЗАЧИНЕНО",
        closedKR: "닫은",
        closedEN: "CLOSED",
    },
    slideshow: function (json, container, soupContainer, foodContainer) {
        if (json.length === 0) {
            console.log("zárva")
            setInterval(() => {
                let now = new Date();
                let sec = now.getSeconds();
                console.log(sec)
                switch (true) {
                    case sec === 0:
                        location.reload();
                        break;
                    case sec >= 1 && sec < 15:
                        container.innerHTML = DOM.closeList.closedHU
                        break;
                    case sec >= 15 && sec < 30:
                        container.innerHTML = DOM.closeList.closedEN
                        break;
                    case sec >= 30 && sec < 45:
                        container.innerHTML = DOM.closeList.closedUA
                        break;
                    case sec >= 45:
                        container.innerHTML = DOM.closeList.closedKR
                        break;
                }
            }, 1000)
        } else {
            setInterval(() => {
                let now = new Date();
                let sec = now.getSeconds()
                console.log(sec)
                switch (true) {
                    case sec === 0:
                        location.reload();
                        break;
                    case sec >= 15 && sec < 30:
                        soupContainer.innerHTML = DOM.foodList.soupEN
                        foodContainer.innerHTML = DOM.foodList.foodEN
                        break;
                    case sec >= 30 && sec < 45:
                        soupContainer.innerHTML = DOM.foodList.soupUA
                        foodContainer.innerHTML = DOM.foodList.foodUA
                        break;
                    case sec >= 45:
                        soupContainer.innerHTML = DOM.foodList.soupKR
                        foodContainer.innerHTML = DOM.foodList.foodKR
                        break;
                }
            }, 1000)
        }
    }, fetchData: () => {
        let soupContainer = document.querySelector('#soup-name');
        let foodContainer = document.querySelector('#food-name');
        let priceContainer = document.querySelector('#food-price');
        let pultNameContainer = document.querySelector('#pult-name');
        let flagContainer = document.querySelector('#flag');
        let container = document.querySelector('.container');
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const id = urlParams.get('id');
        pultNameContainer.innerHTML = id;
        fetch('/json-output?id=' + id)
            .then(response => response.json())
            .then(json_response => {
                console.log(json_response);
                if (json_response.length !== 0) {
                    DOM.foodList.foodHU = json_response.HU.main;
                    DOM.foodList.foodEN = json_response.EN.main;
                    DOM.foodList.foodUA = json_response.UA.main;
                    DOM.foodList.foodKR = json_response.KR.main;
                    DOM.foodList.soupHU = json_response.HU.soup;
                    DOM.foodList.soupEN = json_response.EN.soup;
                    DOM.foodList.soupUA = json_response.UA.soup;
                    DOM.foodList.soupKR = json_response.KR.soup;
                    priceContainer.innerHTML = json_response.HU.price + " HUF";
                    soupContainer.innerHTML = DOM.foodList.soupHU;
                    foodContainer.innerHTML = DOM.foodList.foodHU;
                    console.log(DOM.foodList.soupHU);
                }
                DOM.slideshow(json_response, container, soupContainer, foodContainer);
            })
    }
}

DOM.init();