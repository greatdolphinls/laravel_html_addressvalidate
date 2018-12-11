/**
 * Created by JACKKY on 11/23/2016.
 */


$(document).ready(function(){
    var len = 0;
    var arr = [];
    const cnt = {
        ZERO: 0,
        COUNT: 5
    };

    $(':file').change(function(){
        var length = 0;
        if(len == cnt.ZERO){
            length = this.files.length <= cnt.COUNT ? this.files.length-len : cnt.COUNT;
        }else if(len == cnt.COUNT){
            return;
        }else{
            length = cnt.COUNT - len;
        }
        for(var i = 0; i < length; i++) {
            var file = this.files[i];
            var array = [];
            // if(!checkDuple(file.name.toLowerCase(), file.type))
            //     continue;
            array['name'] = file.name.toLowerCase();
            array['size'] = file.size;
            array['type'] = file.type;
            len++;
            arr.push(array);
        }
        showFiles();
    });

    // function checkDuple(name, size) {
    //     for(var i = 0; i < arr.length; i++){
    //         if(arr[i].name == name && arr[i].size == size)
    //             return false;
    //     }
    //     return true;
    // }

    function showFiles() {
        var str = '';
        for(var i = 0; i < arr.length; i++) {
            str += "<div class='col-md-6 first_progressbar paddingrightzero'>";
            str += "<div class='progress'>";
            str += "<div class='progress-bar' role='progressbar' aria-valuenow='30' aria-valuemin='0' aria-valuemax='100' style='width:30%'></div>";
            str += "<div class='inner_progress_text'>";
            str += "<span class='supportspan'>" + arr[i].name + "</span>";
            var id = 'del_'+i;
            str += "<img src='images/close.png' class='pull-right del_img' id="+'del_'+i+" />";
            str += "<span class='file_size pull-right'>" + Math.round(arr[i].size) + "Byte</span>";
            str += "</div>";
            str += "</div>";
            str += "</div>";
        }
        $('#files_replace').html(str);

        $('img.del_img').click(function(){
            var id = $(this).attr('id');
            id = id.charAt(4);
            arr.splice(id, 1);
            len--;
            showFiles();
        });
    }

    $("#message").keypress(function(){
        var length = $("#message").val().length;
        $("span#letters").html(length);
    });
    
});