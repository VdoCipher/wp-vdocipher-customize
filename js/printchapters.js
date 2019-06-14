function printChapters(){
  var vdoChapter = [];
  for (var i = 0; i < vdoChapters.chaptersArr.length; i++){
    if (!Number.isNaN(Number(vdoChapters.chaptersArr[i]))){
      vdoChapter.push(Number(vdoChapters.chaptersArr[i]));
    }
  }
  var htmlStr = '<div class="vdo-overlay">';
  for (var j = 0; j < vdoChapter.length; j++ ) {
    htmlStr = htmlStr
      .concat('<button ')
      .concat('id="chapter').concat(String(j+1)).concat('" ')
      .concat('mpml-on-click="seek" mpml-click-args="').concat(String(vdoChapter[j])).concat('"')
      .concat('>')
      .concat('Chapter ').concat(String(j+1))
      .concat('</button>');
  }
  htmlStr = htmlStr.concat('</div>');

   var v = vdo.getObjects()[0];
  v.addEventListener('mpmlLoad', () => {
    v.injectThemeHtml(htmlStr);
  });
}
