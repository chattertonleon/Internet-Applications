console.log('index.js is executing');
var express = require('express');
var app = express();
var router = express.Router();

const request = require('superagent');
const status = require('http-status');

router.get(
  '/',
  function(req,res){
    res.send('Hello, World!');
  }
);

router.post(
  '/',
  function(req,res){
    res.sendStatus(status.METHOD_NOT_ALLOWED);
  }
);

var port = 3000;
app.listen(port,function(){
  console.log('Listening on port ' + port);
});

app.use('/',router);

module.exports = router;
