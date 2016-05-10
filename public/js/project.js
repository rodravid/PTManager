$(document).ready(function(){
    $('.btnEdit').click(function(){
        $('.typeSubmit').val(2);
        changeAction();
        $('#projectID').val($(this).val());
        $('#projectTitle').val($("#project"+$(this).val()+"Title").text());
        $('#projectDescription').val($("#project"+$(this).val()+"Description").text());

    });

    $('.typeSubmit').change(function(){
        changeAction();
    });
});

function changeAction(){
    if($('.typeSubmit').val()==1) {
        $(".projectForm").attr('action', '/projects/save');
        $('#projectID').val("");
        $('#projectTitle').val("");
        $('#projectDescription').val("");
    }else
        $(".projectForm").attr('action', '/projects/update');
}