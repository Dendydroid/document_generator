Макрос для списков

function copySheetsToSS() {
  var ss = SpreadsheetApp.getActive();
  for(var n in ss.getSheets()){
    var sheet = ss.getSheets()[n];// look at every sheet in spreadsheet
    var name = sheet.getName();//get name
    if(name != 'master' && name != 'test'){ // exclude some names
      var alreadyExist = DriveApp.getFilesByName(name);// check if already there
      while(alreadyExist.hasNext()){
        alreadyExist.next().setTrashed(true);// delete all files with this name
      }
      var copy = SpreadsheetApp.create(name);// create the copy
      sheet.copyTo(copy);// copy content
      copy.deleteSheet(copy.getSheets()[0]);// remove original "Sheet1"
      copy.getSheets()[0].setName(name);// rename first sheet to same name as SS
    }
  }
}
