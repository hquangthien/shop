const DOMAIN = 'http://shop.dev/admin/';
const DOMAIN_PUBLIC = 'http://shop.dev/';
const DOMAIN_BAN = 'http://shop.dev/ban/';

function addCommas(nStr)
{
    var number = nStr.pả({format:"#,###.00", locale:"us"}, false)
    alert(number);
}

function showItemPublic(url, id, callBackOnSuccess, callBackOnError) {
    $.ajax({
        url: DOMAIN_PUBLIC + url + '/' + id,
        type: 'GET',
        async: true,
        success: function (data) {
            callBackOnSuccess(data);
        },
        error: function (error) {
            callBackOnError(error);
        }
    });
}

function showItem(url, id, callBackOnSuccess, callBackOnError) {
    $.ajax({
        url: DOMAIN_BAN + url + '/' + id + '/detail',
        type: 'GET',
        async: true,
        success: function (data) {
            callBackOnSuccess(data);
        },
        error: function (error) {
            callBackOnError(error);
        }
    });
}

function showItemAdmin(url, id, shop_id , callBackOnSuccess, callBackOnError) {
    $.ajax({
        url: DOMAIN + url + '/' + shop_id + '/detail' + '-' + id,
        type: 'GET',
        async: true,
        success: function (data) {
            callBackOnSuccess(data);
        },
        error: function (error) {
            callBackOnError(error);
        }
    });
}

function updateActive(url, id, callBackOnSuccess, callBackOnError) {
    $.ajax({
        url: DOMAIN + url + '/' + id,
        type: 'GET',
        async: true,
        dataType: 'JSON',
        success: function (data) {
            callBackOnSuccess(data);
        },
        error: function (error) {
            callBackOnError(error);
        }
    });
}

function commentPublic(url, data, callBackOnSuccess, callBackOnError) {
    $.ajax({
        url: DOMAIN_PUBLIC + url,
        type: 'GET',
        async: true,
        data: data,
        success: function (data) {
            callBackOnSuccess(data);
        },
        error: function (error) {
            callBackOnError(error);
        }
    });
}

function updateActivePublic(url, id, callBackOnSuccess, callBackOnError) {
    $.ajax({
        url: DOMAIN_PUBLIC + url + '/' + id,
        type: 'GET',
        async: true,
        dataType: 'JSON',
        success: function (data) {
            callBackOnSuccess(data);
        },
        error: function (error) {
            callBackOnError(error);
        }
    });
}

function addToCartQty(url, id, qty ,callBackOnSuccess, callBackOnError) {
    $.ajax({
        url: DOMAIN_PUBLIC + url + '/' + id,
        type: 'GET',
        async: true,
        dataType: 'JSON',
        data: { qty: qty},
        success: function (data) {
            callBackOnSuccess(data);
        },
        error: function (error) {
            callBackOnError(error);
        }
    });
}

function updateActiveBan(url, id, callBackOnSuccess, callBackOnError) {
    $.ajax({
        url: DOMAIN_BAN + url + '/' + id,
        type: 'GET',
        async: true,
        dataType: 'JSON',
        success: function (data) {
            callBackOnSuccess(data);
        },
        error: function (error) {
            callBackOnError(error);
        }
    });
}

function updateStatusAdmin(url, bill_id, status_id, callBackOnSuccess, callBackOnError) {
    $.ajax({
        url: DOMAIN + url + '/' + bill_id + '/' + status_id,
        type: 'GET',
        async: true,
        dataType: 'JSON',
        success: function (data) {
            callBackOnSuccess(data);
        },
        error: function (error) {
            callBackOnError(error);
        }
    });
}

function updateStatus(url, bill_id, status_id, callBackOnSuccess, callBackOnError) {
    $.ajax({
        url: DOMAIN_BAN + url + '/' + bill_id + '/' + status_id,
        type: 'GET',
        async: true,
        dataType: 'JSON',
        success: function (data) {
            callBackOnSuccess(data);
        },
        error: function (error) {
            callBackOnError(error);
        }
    });
}

function statistic(url, callBackOnSuccess, callBackOnError) {
    $.ajax({
        url: DOMAIN + url,
        type: 'GET',
        async: true,
        dataType: 'JSON',
        success: function (data) {
            callBackOnSuccess(data);
        },
        error: function (error) {
            callBackOnError(error);
        }
    });
}
