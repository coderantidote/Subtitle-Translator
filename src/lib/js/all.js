console.log(`%c 
___________________________________________
|  I'm Security Researcher and I'm Now Cry. |
|___________________________________________|
    \\   ^__^
     \\  (oo)\\_______
        (__)\\       )\\/\\
             ||----w |
             ||     ||`, "color: green; font-size:15px;"); // A little message ;)

function saveFile(name, type, data) {
    if (data != null && navigator.msSaveBlob)
        return navigator.msSaveBlob(new Blob([data], {
            type: type
        }), name);
    var a = $("<a style='display: none;'/>");
    var url = window.URL.createObjectURL(new Blob([data], {
        type: type
    }));
    a.attr("href", url);
    a.attr("download", name);
    $("body").append(a);
    a[0].click();
    window.URL.revokeObjectURL(url);
    a.remove();
} // Blob based download method :)

$(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
}); // Fix Upload Form Bootstrap 

$(document).ready(function() {
    $.post("ajax.php", {
            method: "listsubtitle"
        },
        function(data, status) {
            $('#subtitle_select').html(data);
        });
}); // Document Ready

$("#saveBtn").click(function() {
    var $GetSubtitle = $('#subtitle_txt').text();
    saveFile($('#subtitle_select').val(), "data:text/plain", $GetSubtitle); //fix
}); // Save As Button


$("#Btn_Clean").click(function() {
    $.post("ajax.php", {
            method: "clean"
        },
        function(data, status) {
            $.notify({
                title: '<div class="notranslate"><strong>Successfull!</strong>',
                message: 'Cleaning process has been successfully applied to the folder.</div>'
            }, {
                type: status,
                placement: {
                    from: "bottom",
                    align: "right"
                },
            });
            $.post("ajax.php", {
                    method: "listsubtitle"
                },
                function(data, status) {
                    $('#subtitle_select').html(data);
                    $('#original_txt').text("");
                    $('#subtitle_txt').text("");
                });
        });
}); // Cleaner Button


$("#btn_subtitle_slct").click(function() {
    $.post("ajax.php", {
            method: "select",
            subtitle: $('#subtitle_select').val()
        },
        function(data, status) {
            $.notify({
                title: '<div class="notranslate"><strong>Successfull!</strong>',
                message: 'Subtitle is loaded.</div>'

            }, {
                placement: {
                    from: "bottom",
                    align: "right"
                },
                type: status
            });

            $('#original_txt').text(data);
            $('#subtitle_txt').text(data);
            var data = $('#subtitle_txt').text();

            const FixTime = data.replace(/\d{2}:\d{2}:\d{2}(,\d{3}|.\d{2}) --> \d{2}:\d{2}:\d{2}(,\d{3}|.\d{2})/g, (match, $1) => {
                data = data.replace(match, '<x class="notranslate" style="color:#d62c1a">' + match + '</x>');
                console.log(match)
            });
            $("#subtitle_txt").html(data);
        }); // Select Subtitle
});
$('#uploadForm').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        processData: false,
        beforeSend: function() {
            $.notify({
                title: '<div class="notranslate"><strong>Upload Your Subtitle...<strong>',
                message: 'Please wait..</div>'
            }, {
                placement: {
                    from: "bottom",
                    align: "right"
                },
                type: "warning"
            });
        },
        success: function(data) {
            $.notify({
                title: '<div class="notranslate"><strong>Upload Successfull...<strong>',
                message: data + '</div>'
            }, {
                placement: {
                    from: "bottom",
                    align: "right"
                },
                type: "success"
            });
            $.post("ajax.php", {
                    method: "listsubtitle"
                },
                function(data, status) {
                    $('#subtitle_select').html(data);
                });
            //console.log(data);
            $('#uploadForm')[0].reset();
        }
    });
}); // Upload File