console.log('index.js is executing');
var express = require('express');
var app = express();
var router = express.Router();
var dataLayer = require('../lib/messages.js')

const request = require('superagent');
const status = require('http-status');

router.get(
  '/api/v1/messages/:id',
  function(req,res){
    
  }
);

var port = 3000;
app.listen(port,function(){
  console.log('Listening on port ' + port);
});

app.use('/',router);

module.exports = router;
