// Example of process of 'GET' in 'node.js'

const http = require('http'); // http 를 객체로 활용하기 위한 모듈
const url = require('url'); // url 을 객체로 활용하기 위한 모듈
const port = 1337;
const queryString = require('querystring'); // url 내의 Query String 을 객체로 활용하기 위한 모듈

const server = http.createServer(function (req, res) {
    console.log('--- log start ---');
    let parsedUrl = url.parse(req.url);
    console.log(parsedUrl);
    let parsedQuery = queryString.parse(parsedUrl.query, '&', '=');
    console.log(parsedQuery);
    console.log('--- log end ---');

    res.writeHead(200, {'Content-Type': 'text/html'});
    res.end('Hello node.js!!');

});

server.listen(port, function () {
    console.log('Server is running....');
});