const DOM = {
    init: () => {
        DOM.slideShow();
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
    slideShow: () => {
        let soupContainer = document.querySelector('#soup-name');
        let foodContainer = document.querySelector('#food-name');
        let priceContainer = document.querySelector('#food-price');
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const id = urlParams.get('id');
        let json;
        fetch('/json-output?id=' + id)
            .then(response => response.json())
            .then(json_response => {
                console.log(json_response);
                json = json_response;
                DOM.foodList.foodHU = json_response.HU.main;
                DOM.foodList.foodEN = json_response.EN.main;
                DOM.foodList.foodUA = json_response.UA.main;
                DOM.foodList.foodKR = json_response.KR.main;
                DOM.foodList.soupHU = json_response.HU.soup;
                DOM.foodList.soupEN = json_response.EN.soup;
                DOM.foodList.soupUA = json_response.UA.soup;
                DOM.foodList.soupKR = json_response.KR.soup;
                priceContainer.innerHTML = json_response.HU.price;
                soupContainer.innerHTML = DOM.foodList.soupHU;
                foodContainer.innerHTML = DOM.foodList.foodHU;
                console.log(DOM.foodList.soupHU);
            })
        if (json.length === 0) {

        } else {
            setInterval(() => {
                let now = new Date();
                console.log(now.getSeconds())
                switch (now.getSeconds()) {
                    case 0:
                        location.reload();
                        break;
                    case 15:
                        soupContainer.innerHTML = DOM.foodList.soupEN
                        foodContainer.innerHTML = DOM.foodList.foodEN
                        break;
                    case 30:
                        soupContainer.innerHTML = DOM.foodList.soupUA
                        foodContainer.innerHTML = DOM.foodList.foodUA
                        break;
                    case 45:
                        soupContainer.innerHTML = DOM.foodList.soupKR
                        foodContainer.innerHTML = DOM.foodList.foodKR
                        break;

                }
            }, 1000)
        }
    }
}

DOM.init();