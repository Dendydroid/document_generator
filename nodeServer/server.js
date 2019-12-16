const fs = require('fs');
const conversionFactory = require('html-to-xlsx');
const puppeteer = require('puppeteer');
const chromeEval = require('chrome-page-eval')({ puppeteer });
const express = require('express');
var path = require('path');
const bodyParser = require('body-parser');

const PORT = 5000;
const filePath = "/home/user/Downloads/output.xlsx";

const conversion = conversionFactory({
    extract: chromeEval
});

const app = express();
app.use(bodyParser.json({limit: '500mb', extended: true}));
app.use(bodyParser.urlencoded({limit: '500mb', extended: true}));

async function run (html) {
    const stream = await conversion(html);
    return await new Promise((resolve, reject) => {
        stream.pipe(fs.createWriteStream(filePath));
        stream.on('end', resolve);
    });
}

app.post('/html2Excel', (req, res) => {
    let html = req.body.html;
    run(html).then(() => {
        res.download(filePath, path.basename(filePath));
    }).catch((e) => {
        console.log(e);
    });
});

app.listen(PORT, function () {
    console.log(`Server is running on port ${PORT}`);
});

