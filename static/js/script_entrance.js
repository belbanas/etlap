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
    flagList: {
        HU: "nincs",
        EN: `<img src="/static/images/flag_EN.png" alt="English flag">`,
        UA: "nincs",
        KR: "nincs",
    },
    containers: {
        soupContainer: document.querySelector('#soup-name'),
        foodContainer: document.querySelector('#food-name'),
        priceContainer: document.querySelector('#food-price'),
        pultNameContainer: document.querySelector('#pult-name'),
        flagContainer: document.querySelector('#flag'),
        container: document.querySelector('.container'),
        soupPicContainer: document.querySelector('#soup-pic'),
        mainPicContainer: document.querySelector('#main-pic'),
    },
    slideshow: function (json) {
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
                        DOM.containers.container.innerHTML = DOM.closeList.closedHU
                        DOM.containers.flagContainer.innerHTML = DOM.flagList.HU
                        break;
                    case sec >= 15 && sec < 30:
                        DOM.containers.container.innerHTML = DOM.closeList.closedEN
                        DOM.containers.flagContainer.innerHTML = DOM.flagList.EN
                        break;
                    case sec >= 30 && sec < 45:
                        DOM.containers.container.innerHTML = DOM.closeList.closedUA
                        DOM.containers.flagContainer.innerHTML = DOM.flagList.UA
                        break;
                    case sec >= 45:
                        DOM.containers.container.innerHTML = DOM.closeList.closedKR
                        DOM.containers.flagContainer.innerHTML = DOM.flagList.KR
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
                    case sec >= 1 && sec < 15:
                        DOM.containers.soupContainer.innerHTML = DOM.foodList.soupHU
                        DOM.containers.foodContainer.innerHTML = DOM.foodList.foodHU
                        DOM.containers.flagContainer.innerHTML = DOM.flagList.HU
                        break;
                    case sec >= 15 && sec < 30:
                        DOM.containers.soupContainer.innerHTML = DOM.foodList.soupEN
                        DOM.containers.foodContainer.innerHTML = DOM.foodList.foodEN
                        DOM.containers.flagContainer.innerHTML = DOM.flagList.EN
                        break;
                    case sec >= 30 && sec < 45:
                        DOM.containers.soupContainer.innerHTML = DOM.foodList.soupUA
                        DOM.containers.foodContainer.innerHTML = DOM.foodList.foodUA
                        DOM.containers.flagContainer.innerHTML = DOM.flagList.UA
                        break;
                    case sec >= 45:
                        DOM.containers.soupContainer.innerHTML = DOM.foodList.soupKR
                        DOM.containers.foodContainer.innerHTML = DOM.foodList.foodKR
                        DOM.containers.flagContainer.innerHTML = DOM.flagList.KR
                        break;
                }
            }, 1000)
        }
    },
    fetchData: () => {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const id = urlParams.get('id');
        DOM.containers.pultNameContainer.innerHTML = id;
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
                    DOM.containers.priceContainer.innerHTML = json_response.HU.price + " HUF";
                    DOM.containers.soupContainer.innerHTML = DOM.foodList.soupHU;
                    DOM.containers.foodContainer.innerHTML = DOM.foodList.foodHU;
                    DOM.containers.soupPicContainer.src = "kepek/" + json_response.HU.soupPic;
                    DOM.containers.mainPicContainer.src = "kepek/" + json_response.HU.mainPic;
                    console.log(DOM.foodList.soupHU);
                }
                DOM.slideshow(json_response);
            })
    }
}

DOM.init();