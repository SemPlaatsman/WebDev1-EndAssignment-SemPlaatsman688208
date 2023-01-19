// method to download file based on this jsfiddle: http://jsfiddle.net/sz76c083/1/
function downloadFile(id) {
    URL = 'https://www.googleapis.com/books/v1/volumes/' + id;
    $.ajax({
        url: URL.toString(),
        dataType: 'json',
        success: function(data){
            var jsonData = "text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(data));
            var download = document.createElement('a');
            download.href = 'data:' + jsonData;
            download.download = id + '.json';
            download.click();
        }
    });
}