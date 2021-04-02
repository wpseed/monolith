require("./bootstrap");

import Monolith from "./Monolith";

(function() {
  this.CreateMonolith = function(config) {
    return new Monolith(config);
  };
}.call(window));
