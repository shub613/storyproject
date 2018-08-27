'use strict';

var showCount = 12;
var start = showCount;
var working = false;
var counter = 0;

var helpers = {formatSize: formatSize};

function populateCards(config) {
    $.getJSON({
        type: "POST",
        url: config.url,
        data: config.data,
        success: function (data) {
            // console.log(data);
            // data = JSON.parse(JSON.stringify(data));
            $(config.placeholder).html('');
            if (data.length > 0) {
                $.views.settings.allowCode(true);
                $(config.placeholder).html($(config.template).render(data, helpers));
                start = showCount;
                counter++;
                infiniteScroll(config);
                working = false;
            } else {
                var str = $(config.placeholder).val();
                console.log(str);
                if (str === '') {
                    alert("No Data Found");
                }
            }
        },
        error: function (err) {
            console.log(err);
        }
    });
}

function infiniteScroll(config) {
    $(config.element).scroll(function () {
        config.data.from = start;
        if (($(config.element).scrollTop()) >= (($(config.placeholder)[0].scrollHeight) - 950)) {
            if (working === false) {
                working = true;
                $.getJSON({
                    type: "POST",
                    url: config.url,
                    data: config.data,
                    success: function (data) {
                        // data = JSON.parse(JSON.stringify(data));
                        var postion = $(config.element).scrollTop();
                        if (data.length > 0) {
                            $(config.placeholder).append($(config.template).render(data, helpers));
                            $(config.element).scrollTop(postion);
                            start += showCount;
                            working = false;
                        } else {
                            alert('No More Records Left !!');
                        }
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            }
        }

    });
}

function formatSize(value, size) {
    if (value.length > size) {
        return value.substr(0, size) + '...';
    } else {
        return value;
    }
}
