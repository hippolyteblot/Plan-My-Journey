function changeCommentaryIdForReport(commentaryId) {
    document.getElementsByName("commentaryIdForReport")[0].value = commentaryId;
    console.log("commentaryIdForReport: " + commentaryId);
}

var commentariesList = document.getElementsByClassName("report-btn");
for (var i = 0; i < commentariesList.length; i++) {
    commentariesList[i].addEventListener("click", function () {
        changeCommentaryIdForReport(this.value);
    });
}