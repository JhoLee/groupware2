// Example of process of 'POST' in 'node.js'

const http = require('http');
const port = 1339;
const querystring = require('querystring');

const server = http.createServer(function (req, res) {
    console.log('[info] Log Start...');
    let postdata = '';
    req.on('data', function (data) {
        postdata = postdata + data;
    });

    req.on('end', function () {
        let parsedQuery = querystring.parse(postdata);
        console.log(parsedQuery);
        res.writeHead(200, {'Content-Type': 'text/html'});
        res.end('var1의 값 = ' + result);

    });
    console.log('[info] Log End.');

});

server.listen(port, function () {
    console.log('[info] Server is running...');
});