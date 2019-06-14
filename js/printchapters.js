function printChapters(){

  var vdoChapterTime = [];
  for (var i = 0; i < vdoChapters.chaptersTimeArr.length; i++){
    if (!Number.isNaN(Number(vdoChapters.chaptersTimeArr[i]))){
      vdoChapterTime.push(Number(vdoChapters.chaptersTimeArr[i]));
    }
  }
  var vdoChapterName = [];
  if (!vdoChapters.chaptersNameArr){
    for (var i = 0; i < vdoChapters.chaptersTimeArr.length; i++){
      var chapterName = 'Chapter ' + (i+1);
      vdoChapterName.push( chapterName );
    }
  }
  else {
    for (var i = 0; i < vdoChapters.chaptersNameArr.length; i++){
      vdoChapterName.push( vdoChapters.chaptersNameArr[i] );
    }
  }
  var htmlStr = '<div class="vdo-overlay">';
  for (var j = 0; j < vdoChapterTime.length; j++ ) {
    htmlStr = htmlStr
      .concat('<button ')
      .concat('id="chapter').concat(String(j+1)).concat('" ')
      .concat('mpml-on-click="seek" mpml-click-args="').concat(String(vdoChapterTime[j])).concat('"')
      .concat('>')
      .concat(String(vdoChapterName[j]))
      .concat('</button>');
  }
  htmlStr = htmlStr.concat('</div>');

   var v = vdo.getObjects()[0];
  v.addEventListener('mpmlLoad', () => {
    v.injectThemeHtml(htmlStr);
  });
}
