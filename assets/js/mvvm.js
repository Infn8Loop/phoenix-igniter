console.log("MVVM Javascript loaded.");

function bind_mvvm(){
    for (var property in mvvm) {
        $("#mvvm-" + property).val(mvvm[property]);
        $("#mvvm-" + property).attr('data-mvvm', property);
    }
}

bind_mvvm();

$(document).change(function(){
    for (var property in mvvm) {
        mvvm[property] = $("#mvvm-" + property).val();
    }
    console.log(mvvm);
});

function mvvm_update(){
    _post = {
        mvvm: mvvm,
        token: token
    };

    $.ajax({
        method: 'POST',
        url: mvvm_url + 'update',
        data: _post
    });
}

$('#mvvm-update').click(function(){
    mvvm_update()
});

function mvvm_delete(){
    _post = {
        mvvm: mvvm,
        token: token
    };

    $.ajax({
        method: 'POST',
        url: mvvm_url + 'delete',
        data: _post
    });
}

$('#mvvm-delete').click(function(){
    mvvm_delete()
});
