function printChapters(){
  var vdoChapter = [];
  for (var i = 0; i < vdoChapters.chaptersArr.length; i++){
    if (!Number.isNaN(Number(vdoChapters.chaptersArr[i]))){
      vdoChapter.push(Number(vdoChapters.chaptersArr[i]));
    }
  }
  var htmlStr = '<div class="vdo-overlay">';
  for (var j = 0; j < vdoChapter.length; j++ ) {
    htmlStr = htmlStr.concat('<button id="chapter').concat(String(j+1)).concat('">Chapter ').concat(String(j+1)).concat('</button>');
  }
  htmlStr = htmlStr.concat('</div>');

   var v = vdo.getObjects()[0];
  v.addEventListener('mpmlLoad', () => {
    v.injectThemeHtml(htmlStr);
    for (let k = 0; k < vdoChapter.length; k++ ) {
      let vdoChapterStr= 'chapter'.concat(String(k+1));
      console.log(document.getElementById(vdoChapterStr));
      document.getElementById(vdoChapterStr).addEventListener('click', () => console.log('Arsenal'));
      // document.getElementById(vdoChapterStr).addEventListener('click', () => v.seek(vdoChapter[k]));
    }
  });
}
