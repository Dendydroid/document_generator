const fs = require('fs');
const conversionFactory = require('html-to-xlsx');
const puppeteer = require('puppeteer');
const chromeEval = require('chrome-page-eval')({ puppeteer });
const express = require('express');
var path = require('path');
const PORT = 5000;
const filePath = "/projects/DG/document_generator/generator/output.xlsx";
const conversion = conversionFactory({
    extract: chromeEval
});
const app = express();
app.use(express.urlencoded());
//`<table><tr><td rowspan=5 colspan=5 style="text-align:center;border-left-style:solid;border-right-style:solid;border-bottom-style:solid;font-size:18px;border-bottom-color:deeppink;background-color:greenyellow;border-top-style:solid;font-weight:800;font-style:italic;width:auto;color:red">cell ПРИВЕТПРИВЕТПРИВЕТПРИВЕТПРИВ<br>ЕТПРИВЕТПРИВЕТПРИВЕТ</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr><tr><td>1</td></tr></table>`
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
    });
});

app.listen(PORT, function () {
    console.log(`Server is running on port ${PORT}`);
});

