const fs = require('fs');
const moment = require('moment');
fs.writeFile("/tmp/test", "Hey there!"+moment().format("HH:mm:ss"), function(err) {
    if(err) {
        return console.log(err);
    }

    console.log("The file was saved!");
    process.exit()
}); 