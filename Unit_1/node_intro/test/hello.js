const chai = require('chai');
const expect = chai.expect;
const request = require('superagent');
const status = require('http-status');

const apiRoot = 'http://localhost:3000/';

var serverCode = require('../routes/hello.js');

describe('API test for Web layer', function(){

  var messages;
  const validMessages = [
    {
      username:'Alice',
      text:'Alice\'s Message'
    },
    {
      username:'Bob',
      text:'Bob\'s Message'
    }
  ];

  it ('GET to /api/v1/messages/:id gets all messages.', function(done){
    const MESSAGE_IDX = 0;
       messages.create(validMessages[MESSAGE_IDX],function(err,res){
         expect(res).to.be.an('object');
         expect(res).to.have.property('_id');
         request.get(apiRoot + res.id)
          .end(function(err,res){
            expect(err).to.be.null;
            expect(statusCode).to.equal(status.OK);
            expect(res.body).to.be.an('object');
            expect(res.body).to.have.property('username');
            expect(res.body).to.have.property('text');
            expect(res.body.username).to.equal(validMessages[MESSAGE_IDX].username);
            expect(res.body.text).to.equal(validMessages[MESSAGE_IDX].text);
            done()
         });
       });
   });
});
