"use strict";

var DOM = {
    init: function init() {
        DOM.fetchData();
    },
    type: "",
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
        food2KR: ""
    },
    closeList: {
        closedHU: "ZÁRVA",
        closedUA: "ЗАЧИНЕНО",
        closedKR: "닫힘",
        closedEN: "CLOSED"
    },
    flagList: {
        HU:
            '<img src="static/images/flag_HU.png" alt="Hungarian flag" class="flag">',
        EN: '<img src="static/images/flag_EN.png" alt="English flag" class="flag">',
        UA:
            '<img src="static/images/flag_UA.png" alt="Ukrainian flag" class="flag">',
        KR: '<img src="static/images/flag_KR.png" alt="Korean flag" class="flag">'
    },
    containers: {
        body: document.querySelector("body"),
        mainContent: document.querySelector(".main-content"),
        soupContainer: document.querySelector("#soup-name"),
        foodContainer: document.querySelector("#food-name"),
        food2Container: document.querySelector("#food-name2"),
        priceContainer: document.querySelector("#food-price"),
        pultNameContainer: document.querySelector("#pult-name"),
        flagContainer: document.querySelector("#flag"),
        mainFlagContainer: document.querySelector("#main-flag"),
        closeFlagContainer: document.querySelector("#close-flag"),
        container: document.querySelector(".container"),
        soupPicContainer: document.querySelector("#soup-pic"),
        mainPicContainer: document.querySelector("#main-pic"),
        defaultLanguageFoodContainer: document.querySelector(
            "#default-language-food"
        ),
        defaultLanguageFood2Container: document.querySelector(
            "#default-language-food2"
        ),
        defaultLanguageSoupContainer: document.querySelector(
            "#default-language-soup"
        ),
        closeSignContainer: document.querySelector("#close-sign"),
        closeContainer: document.querySelector("#close-container")
    },
    slideshow: function slideshow(json) {
        if (json.length === 0) {
            //DOM.containers.mainContent.innerHTML = "";
            DOM.containers.mainContent.classList.add("hidden");
            DOM.containers.closeContainer.classList.remove("hidden");
            DOM.containers.pultNameContainer.innerHTML = "";
            console.log("zárva");
            var lang = "";
            var timer = setInterval(function () {
                var now = new Date();
                var sec = now.getSeconds();
                var min = now.getMinutes();

                if (min == 45 && sec == 0) {
                    location.reload();
                }

                console.log(sec);
                console.log(min);

                switch (true) {
                    case sec === 0:
                        console.log('hello');
                        //location.reload();
                        clearInterval(timer);
                        DOM.init();
                        break;

                    case sec >= 1 && sec < 15:
                        if (lang != "HU") {
                            DOM.containers.closeFlagContainer.innerHTML = '<div class="anim">'.concat(
                                DOM.flagList.HU,
                                "</div>"
                            );
                            DOM.containers.closeSignContainer.innerHTML = '<div class="anim">'.concat(
                                DOM.closeList.closedHU,
                                "</div>"
                            );
                            lang = "HU";
                        }

                        break;

                    case sec >= 15 && sec < 30:
                        if (lang != "EN") {
                            DOM.containers.closeFlagContainer.innerHTML = '<div class="anim">'.concat(
                                DOM.flagList.EN,
                                "</div>"
                            );
                            DOM.containers.closeSignContainer.innerHTML = '<div class="anim">'.concat(
                                DOM.closeList.closedEN,
                                "</div>"
                            );
                            lang = "EN";
                        }

                        break;

                    case sec >= 30 && sec < 45:
                        if (lang != "UA") {
                            DOM.containers.closeFlagContainer.innerHTML = '<div class="anim">'.concat(
                                DOM.flagList.UA,
                                "</div>"
                            );
                            DOM.containers.closeSignContainer.innerHTML = '<div class="anim">'.concat(
                                DOM.closeList.closedUA,
                                "</div>"
                            );
                            lang = "UA";
                        }

                        break;

                    case sec >= 45:
                        if (lang != "KR") {
                            DOM.containers.closeFlagContainer.innerHTML = '<div class="anim">'.concat(
                                DOM.flagList.KR,
                                "</div>"
                            );
                            DOM.containers.closeSignContainer.innerHTML = '<div class="anim">'.concat(
                                DOM.closeList.closedKR,
                                "</div>"
                            );
                            lang = "KR";
                        }

                        break;
                }
            }, 100);
        }
    },
    fetchData: function fetchData() {
        var queryString = window.location.search;
        var urlParams = new URLSearchParams(queryString);
        var id = urlParams.get("id");
        var time = urlParams.get("time");
        var day = urlParams.get("day");

        var url = "json_output.php?id=" + id;

        if (time != null) {
            url = "json_output.php?id=" + id + "&time=" + time;
        }
        if (day != null) {
            url = "json_output.php?id=" + id + "&day=" + day
        }
        if (time != null && day != null) {
            url = "json_output.php?id=" + id + "&time=" + time + "&day=" + day;
        }

        DOM.containers.mainFlagContainer.innerHTML = DOM.flagList.HU;

        var timeout = setTimeout(function(){
            location.reload();
        }, 60000) // 1perc múlva újratölti az oldalt

        fetch(url)
            .then(function (response) {
                return response.json();
            })
            .then(function (json_response) {
                console.log(json_response);

                if (json_response.length !== 0) {
                    DOM.type = json_response.HU.type;
                    DOM.containers.pultNameContainer.innerHTML = DOM.type;
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

                    DOM.containers.defaultLanguageSoupContainer.innerHTML =
                        DOM.foodList.soupHU;
                    DOM.containers.defaultLanguageFoodContainer.innerHTML =
                        DOM.foodList.foodHU;
                    DOM.containers.defaultLanguageFood2Container.innerHTML =
                        DOM.foodList.food2HU;

                    DOM.containers.soupContainer.innerHTML =
                        DOM.foodList.soupEN;
                    DOM.containers.foodContainer.innerHTML =
                        DOM.foodList.foodEN;
                    DOM.containers.food2Container.innerHTML =
                        DOM.foodList.food2EN;

                    DOM.containers.flagContainer.innerHTML = DOM.flagList.EN;

                    DOM.containers.mainPicContainer.src =
                        "kepek/" + json_response.HU.mainPic + "?v=" + Math.floor((Math.random() * 100) + 1);
                    console.log(DOM.foodList.soupHU);
                }

                DOM.slideshow(json_response);
                clearTimeout(timeout);
            })
            .catch(function (error) {
                // window.alert("Valami hiba történt")
                location.reload();
            });
    }
};

(function (w) {

    w.URLSearchParams = w.URLSearchParams || function (searchString) {
        var self = this;
        self.searchString = searchString;
        self.get = function (name) {
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(self.searchString);
            if (results == null) {
                return null;
            }
            else {
                return decodeURI(results[1]) || 0;
            }
        };
    }

})(window)


DOM.init();