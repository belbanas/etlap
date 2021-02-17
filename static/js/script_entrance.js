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
        food2HU: "",
        food2EN: "",
        food2UA: "",
        food2KR: "",
    },
    closeList: {
        closedHU: "ZÁRVA",
        closedUA: "ЗАЧИНЕНО",
        closedKR: "닫은",
        closedEN: "CLOSED",
    },
    flagList: {
        HU: `<img src="/static/images/flag_HU.png" alt="Hungarian flag" class="flag">`,
        EN: `<img src="/static/images/flag_EN.png" alt="English flag" class="flag">`,
        UA: `<img src="/static/images/flag_UA.png" alt="Ukrainian flag" class="flag">`,
        KR: `<img src="/static/images/flag_KR.png" alt="Korean flag" class="flag">`,
    },
    containers: {
        body: document.querySelector('body'),
        mainContent: document.querySelector('.main-content'),
        soupContainer: document.querySelector('#soup-name'),
        foodContainer: document.querySelector('#food-name'),
        food2Container: document.querySelector('#food-name2'),
        priceContainer: document.querySelector('#food-price'),
        pultNameContainer: document.querySelector('#pult-name'),
        flagContainer: document.querySelector('#flag'),
        mainFlagContainer: document.querySelector('#main-flag'),
        closeFlagContainer: document.querySelector('#close-flag'),
        container: document.querySelector('.container'),
        soupPicContainer: document.querySelector('#soup-pic'),
        mainPicContainer: document.querySelector('#main-pic'),
        defaultLanguageFoodContainer: document.querySelector('#default-language-food'),
        defaultLanguageFood2Container: document.querySelector('#default-language-food2'),
        defaultLanguageSoupContainer: document.querySelector('#default-language-soup'),
        closeSignContainer: document.querySelector('#close-sign'),
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
                        DOM.containers.mainContent.innerHTML = ""
                        DOM.containers.closeFlagContainer.innerHTML = DOM.flagList.HU
                        DOM.containers.closeSignContainer.innerHTML = DOM.closeList.closedHU
                        break;
                    case sec >= 15 && sec < 30:
                        DOM.containers.mainContent.innerHTML = ""
                        DOM.containers.closeFlagContainer.innerHTML = DOM.flagList.EN
                        DOM.containers.closeSignContainer.innerHTML = DOM.closeList.closedEN
                        break;
                    case sec >= 30 && sec < 45:
                        DOM.containers.mainContent.innerHTML = ""
                        DOM.containers.closeFlagContainer.innerHTML = DOM.flagList.UA
                        DOM.containers.closeSignContainer.innerHTML = DOM.closeList.closedUA
                        break;
                    case sec >= 45:
                        DOM.containers.mainContent.innerHTML = ""
                        DOM.containers.closeFlagContainer.innerHTML = DOM.flagList.KR
                        DOM.containers.closeSignContainer.innerHTML = DOM.closeList.closedKR
                        break;
                }
            }, 100)
        } else {
            setInterval(() => {
                let now = new Date();
                let sec = now.getSeconds()
                console.log(sec)
                const queryString = window.location.search;
                const urlParams = new URLSearchParams(queryString);
                const id = urlParams.get('id');
                switch (true) {
                    case sec === 0:
                        location.reload();
                        break;
                    case (sec >= 0.5 && sec < 5) || (sec >= 15 && sec < 20) || (sec >= 30 && sec < 35) || (sec >= 45 && sec < 50):
                        if (id === "1") {
                            DOM.containers.soupContainer.innerHTML = DOM.foodList.soupHU
                            DOM.containers.foodContainer.innerHTML = DOM.foodList.foodHU
                            DOM.containers.food2Container.innerHTML = DOM.foodList.food2HU
                            DOM.containers.flagContainer.innerHTML = DOM.flagList.HU
                        } else {
                            DOM.containers.soupContainer.innerHTML = DOM.foodList.soupKR
                            DOM.containers.foodContainer.innerHTML = DOM.foodList.foodKR
                            DOM.containers.food2Container.innerHTML = DOM.foodList.food2KR
                            DOM.containers.flagContainer.innerHTML = DOM.flagList.KR
                        }
                        break;
                    case (sec >= 5 && sec < 10) || (sec >= 20 && sec < 25) || (sec >= 35 && sec < 40) || (sec >= 50 && sec < 55):
                        DOM.containers.soupContainer.innerHTML = DOM.foodList.soupEN
                        DOM.containers.foodContainer.innerHTML = DOM.foodList.foodEN
                        DOM.containers.food2Container.innerHTML = DOM.foodList.food2EN
                        DOM.containers.flagContainer.innerHTML = DOM.flagList.EN
                        break;
                    case (sec >= 10 && sec < 15) || (sec >= 25 && sec < 30) || (sec >= 40 && sec < 45) || sec >= 55:
                        DOM.containers.soupContainer.innerHTML = DOM.foodList.soupUA
                        DOM.containers.foodContainer.innerHTML = DOM.foodList.foodUA
                        DOM.containers.food2Container.innerHTML = DOM.foodList.food2UA
                        DOM.containers.flagContainer.innerHTML = DOM.flagList.UA
                        break;
                }
            }, 100)
        }
    },
    fetchData: () => {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const id = urlParams.get('id');
        if (id === "1") {
            DOM.containers.pultNameContainer.innerHTML = "ASIAN";
            DOM.containers.mainFlagContainer.innerHTML = DOM.flagList.KR;
        } else {
            DOM.containers.pultNameContainer.innerHTML = "EUROPEAN " + id;
            DOM.containers.mainFlagContainer.innerHTML = DOM.flagList.HU;
        }
        fetch('/json_output.php?id=' + id)
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
                    DOM.foodList.food2HU = json_response.HU["second"];
                    DOM.foodList.food2EN = json_response.EN["second"];
                    DOM.foodList.food2UA = json_response.UA["second"];
                    DOM.foodList.food2KR = json_response.KR["second"];
                    DOM.containers.priceContainer.innerHTML = json_response.HU.price;
                    if (id === "1") {
                        DOM.containers.defaultLanguageSoupContainer.innerHTML = DOM.foodList.soupKR;
                        DOM.containers.defaultLanguageFoodContainer.innerHTML = DOM.foodList.foodKR;
                        DOM.containers.defaultLanguageFood2Container.innerHTML = DOM.foodList.food2KR;
                    } else {
                        DOM.containers.defaultLanguageSoupContainer.innerHTML = DOM.foodList.soupHU;
                        DOM.containers.defaultLanguageFoodContainer.innerHTML = DOM.foodList.foodHU;
                        DOM.containers.defaultLanguageFood2Container.innerHTML = DOM.foodList.food2HU;
                    }
                    // DOM.containers.soupPicContainer.src = "kepek/" + json_response.HU.soupPic;
                    DOM.containers.mainPicContainer.src = "kepek/" + json_response.HU.mainPic;
                    // DOM.containers.mainPicContainer.src = "kepek/tarhonyaleves.jpg";
                    console.log(DOM.foodList.soupHU);
                }
                DOM.slideshow(json_response);
            })
    }
}

DOM.init();