// User.js

const mongoose = require('mongoose');
const Schema = mongoose.Schema;

// Define collection and schema
let User = new Schema({
  user_name: {
    type: String
  },
  user_last_name: {
    type: String
  },
  user_company: {
    type: String
  }
},{
    collection: 'angCrud'
});

module.exports = mongoose.model('User', User);