function Send() {
  var frm = $("#FF");
  frm.submit(function(e) {
    e.preventDefault();
    $.ajax({
      type: frm.attr("method"),
      url: frm.attr("action"),
      data: frm.serialize(),
      success: function(data) {
        $("#chat_box").text(data);
        $("#chat").val("");
        $("#chat_box").animate(
          { scrollTop: $("#chat_box")[0].scrollHeight },
          1000
        );
      },
      error: function(data) {
        console.log("Error!");
      }
    });
  });
}

function Enter() {
  var frm = $("#log");
  frm.submit(function(e) {
    e.preventDefault();
    $.ajax({
      type: frm.attr("method"),
      url: frm.attr("action"),
      data: frm.serialize(),
      success: function(data) {
        newDoc = document.open("text/html", "replace");
        newDoc.write(data);
        newDoc.close();
      },
      error: function(data) {
        console.log("Error!");
      }
    });
  });
}
