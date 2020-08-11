!function(t,e){"object"==typeof exports&&"undefined"!=typeof module?module.exports=e():"function"==typeof define&&define.amd?define(e):t.IMask=e()}(this,function(){"use strict";var h=function(t){if(null==t)throw TypeError("Can't call method on  "+t);return t},n={}.hasOwnProperty,s=function(t,e){return n.call(t,e)},u={}.toString,e=Object("z").propertyIsEnumerable(0)?Object:function(t){return"String"==(e=t,u.call(e).slice(8,-1))?t.split(""):Object(t);var e},l=function(t){return e(h(t))},i=Math.ceil,r=Math.floor,c=function(t){return isNaN(t=+t)?0:(0<t?r:i)(t)},a=Math.min,f=function(t){return 0<t?a(c(t),9007199254740991):0},p=Math.max,d=Math.min;function t(t,e){return t(e={exports:{}},e.exports),e.exports}var o,v,k,g=t(function(t){var e=t.exports="undefined"!=typeof window&&window.Math==Math?window:"undefined"!=typeof self&&self.Math==Math?self:Function("return this")();"number"==typeof __g&&(__g=e)}),y="__core-js_shared__",_=g[y]||(g[y]={}),m=0,A=Math.random(),C=function(t){return"Symbol(".concat(void 0===t?"":t,")_",(++m+A).toString(36))},F=_[o="keys"]||(_[o]={}),E=(v=!1,function(t,e,n){var u,i,r,a=l(t),s=f(a.length),o=(i=s,(u=c(u=n))<0?p(u+i,0):d(u,i));if(v&&e!=e){for(;o<s;)if((r=a[o++])!=r)return!0}else for(;o<s;o++)if((v||o in a)&&a[o]===e)return v||o||0;return!v&&-1}),b=F[k="IE_PROTO"]||(F[k]=C(k)),B="constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf".split(","),S=Object.keys||function(t){return function(t,e){var n,u=l(t),i=0,r=[];for(n in u)n!=b&&s(u,n)&&r.push(n);for(;e.length>i;)s(u,n=e[i++])&&(~E(r,n)||r.push(n));return r}(t,B)},D=t(function(t){var e=t.exports={version:"2.5.5"};"number"==typeof __e&&(__e=e)}),T=(D.version,function(t){return"object"==typeof t?null!==t:"function"==typeof t}),w=function(t){if(!T(t))throw TypeError(t+" is not an object!");return t},x=function(t){try{return!!t()}catch(t){return!0}},M=!x(function(){return 7!=Object.defineProperty({},"a",{get:function(){return 7}}).a}),P=g.document,O=T(P)&&T(P.createElement),I=!M&&!x(function(){return 7!=Object.defineProperty((t="div",O?P.createElement(t):{}),"a",{get:function(){return 7}}).a;var t}),R=Object.defineProperty,V={f:M?Object.defineProperty:function(t,e,n){if(w(t),e=function(t,e){if(!T(t))return t;var n,u;if(e&&"function"==typeof(n=t.toString)&&!T(u=n.call(t)))return u;if("function"==typeof(n=t.valueOf)&&!T(u=n.call(t)))return u;if(!e&&"function"==typeof(n=t.toString)&&!T(u=n.call(t)))return u;throw TypeError("Can't convert object to primitive value")}(e,!0),w(n),I)try{return R(t,e,n)}catch(t){}if("get"in n||"set"in n)throw TypeError("Accessors not supported!");return"value"in n&&(t[e]=n.value),t}},j=M?function(t,e,n){return V.f(t,e,{enumerable:!((u=1)&u),configurable:!(2&u),writable:!(4&u),value:n});var u}:function(t,e,n){return t[e]=n,t},N=t(function(t){var r=C("src"),e="toString",n=Function[e],a=(""+n).split(e);D.inspectSource=function(t){return n.call(t)},(t.exports=function(t,e,n,u){var i="function"==typeof n;i&&(s(n,"name")||j(n,"name",e)),t[e]!==n&&(i&&(s(n,r)||j(n,r,t[e]?""+t[e]:a.join(String(e)))),t===g?t[e]=n:u?t[e]?t[e]=n:j(t,e,n):(delete t[e],j(t,e,n)))})(Function.prototype,e,function(){return"function"==typeof this&&this[r]||n.call(this)})}),L=function(u,i,t){if(function(t){if("function"!=typeof t)throw TypeError(t+" is not a function!")}(u),void 0===i)return u;switch(t){case 1:return function(t){return u.call(i,t)};case 2:return function(t,e){return u.call(i,t,e)};case 3:return function(t,e,n){return u.call(i,t,e,n)}}return function(){return u.apply(i,arguments)}},H="prototype",G=function(t,e,n){var u,i,r,a,s=t&G.F,o=t&G.G,l=t&G.S,h=t&G.P,c=t&G.B,f=o?g:l?g[e]||(g[e]={}):(g[e]||{})[H],p=o?D:D[e]||(D[e]={}),d=p[H]||(p[H]={});for(u in o&&(n=e),n)r=((i=!s&&f&&void 0!==f[u])?f:n)[u],a=c&&i?L(r,g):h&&"function"==typeof r?L(Function.call,r):r,f&&N(f,u,r,t&G.U),p[u]!=r&&j(p,u,a),h&&d[u]!=r&&(d[u]=r)};g.core=D,G.F=1,G.G=2,G.S=4,G.P=8,G.B=16,G.W=32,G.U=64,G.R=128;var U,z,Y,Z,$=G;U="keys",z=function(){return function(t){return S(Object(h(t)))}},Y=(D.Object||{})[U]||Object[U],(Z={})[U]=z(Y),$($.S+$.F*x(function(){Y(1)}),"Object",Z);D.Object.keys;var K=function(t){var e=String(h(this)),n="",u=c(t);if(u<0||u==1/0)throw RangeError("Count can't be negative");for(;0<u;(u>>>=1)&&(e+=e))1&u&&(n+=e);return n};$($.P,"String",{repeat:K});D.String.repeat;var W=function(t,e,n,u){var i=String(h(t)),r=i.length,a=void 0===n?" ":String(n),s=f(e);if(s<=r||""==a)return i;var o=s-r,l=K.call(a,Math.ceil(o/a.length));return l.length>o&&(l=l.slice(0,o)),u?l+i:i+l},q=g.navigator,J=q&&q.userAgent||"";$($.P+$.F*/Version\/10\.\d+(\.\d+)? Safari\//.test(J),"String",{padStart:function(t){return W(this,t,1<arguments.length?arguments[1]:void 0,!0)}});D.String.padStart;$($.P+$.F*/Version\/10\.\d+(\.\d+)? Safari\//.test(J),"String",{padEnd:function(t){return W(this,t,1<arguments.length?arguments[1]:void 0,!1)}});D.String.padEnd;function Q(t){return(Q="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t})(t)}function X(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function tt(t,e){for(var n=0;n<e.length;n++){var u=e[n];u.enumerable=u.enumerable||!1,u.configurable=!0,"value"in u&&(u.writable=!0),Object.defineProperty(t,u.key,u)}}function et(t,e,n){return e&&tt(t.prototype,e),n&&tt(t,n),t}function nt(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}function ut(){return(ut=Object.assign||function(t){for(var e=1;e<arguments.length;e++){var n=arguments[e];for(var u in n)Object.prototype.hasOwnProperty.call(n,u)&&(t[u]=n[u])}return t}).apply(this,arguments)}function it(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{},u=Object.keys(n);"function"==typeof Object.getOwnPropertySymbols&&(u=u.concat(Object.getOwnPropertySymbols(n).filter(function(t){return Object.getOwnPropertyDescriptor(n,t).enumerable}))),u.forEach(function(t){nt(e,t,n[t])})}return e}function rt(t,e){if("function"!=typeof e&&null!==e)throw new TypeError("Super expression must either be null or a function");t.prototype=Object.create(e&&e.prototype,{constructor:{value:t,writable:!0,configurable:!0}}),e&&st(t,e)}function at(t){return(at=Object.setPrototypeOf?Object.getPrototypeOf:function(t){return t.__proto__||Object.getPrototypeOf(t)})(t)}function st(t,e){return(st=Object.setPrototypeOf||function(t,e){return t.__proto__=e,t})(t,e)}function ot(t,e){if(null==t)return{};var n,u,i=function(t,e){if(null==t)return{};var n,u,i={},r=Object.keys(t);for(u=0;u<r.length;u++)n=r[u],0<=e.indexOf(n)||(i[n]=t[n]);return i}(t,e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);for(u=0;u<r.length;u++)n=r[u],0<=e.indexOf(n)||Object.prototype.propertyIsEnumerable.call(t,n)&&(i[n]=t[n])}return i}function lt(t,e){return!e||"object"!=typeof e&&"function"!=typeof e?function(t){if(void 0===t)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return t}(t):e}function ht(t,e){for(;!Object.prototype.hasOwnProperty.call(t,e)&&null!==(t=at(t)););return t}function ct(t,e,n){return(ct="undefined"!=typeof Reflect&&Reflect.get?Reflect.get:function(t,e,n){var u=ht(t,e);if(u){var i=Object.getOwnPropertyDescriptor(u,e);return i.get?i.get.call(n):i.value}})(t,e,n||t)}function ft(t,e,n,u){return(ft="undefined"!=typeof Reflect&&Reflect.set?Reflect.set:function(t,e,n,u){var i,r=ht(t,e);if(r){if((i=Object.getOwnPropertyDescriptor(r,e)).set)return i.set.call(u,n),!0;if(!i.writable)return!1}if(i=Object.getOwnPropertyDescriptor(u,e)){if(!i.writable)return!1;i.value=n,Object.defineProperty(u,e,i)}else nt(u,e,n);return!0})(t,e,n,u)}function pt(t,e,n,u,i){if(!ft(t,e,n,u||t)&&i)throw new Error("failed to set property");return n}function dt(t,e){return function(t){if(Array.isArray(t))return t}(t)||function(t,e){var n=[],u=!0,i=!1,r=void 0;try{for(var a,s=t[Symbol.iterator]();!(u=(a=s.next()).done)&&(n.push(a.value),!e||n.length!==e);u=!0);}catch(t){i=!0,r=t}finally{try{u||null==s.return||s.return()}finally{if(i)throw r}}return n}(t,e)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance")}()}var vt={NONE:"NONE",LEFT:"LEFT",FORCE_LEFT:"FORCE_LEFT",RIGHT:"RIGHT",FORCE_RIGHT:"FORCE_RIGHT"};function kt(t){return t.replace(/([.*+?^=!:${}()|[\]/\\])/g,"\\$1")}var gt="undefined"!=typeof window&&window||"undefined"!=typeof global&&global.global===global&&global||"undefined"!=typeof self&&self.self===self&&self||{},yt=function(){function i(t,e,n,u){for(X(this,i),this.value=t,this.cursorPos=e,this.oldValue=n,this.oldSelection=u;this.value.slice(0,this.startChangePos)!==this.oldValue.slice(0,this.startChangePos);)--this.oldSelection.start}return et(i,[{key:"startChangePos",get:function(){return Math.min(this.cursorPos,this.oldSelection.start)}},{key:"insertedCount",get:function(){return this.cursorPos-this.startChangePos}},{key:"inserted",get:function(){return this.value.substr(this.startChangePos,this.insertedCount)}},{key:"removedCount",get:function(){return Math.max(this.oldSelection.end-this.startChangePos||this.oldValue.length-this.value.length,0)}},{key:"removed",get:function(){return this.oldValue.substr(this.startChangePos,this.removedCount)}},{key:"head",get:function(){return this.value.substring(0,this.startChangePos)}},{key:"tail",get:function(){return this.value.substring(this.startChangePos+this.insertedCount)}},{key:"removeDirection",get:function(){return!this.removedCount||this.insertedCount?vt.NONE:this.oldSelection.end===this.cursorPos||this.oldSelection.start===this.cursorPos?vt.RIGHT:vt.LEFT}}]),i}(),_t=function(){function e(t){X(this,e),ut(this,{inserted:"",rawInserted:"",skip:!1,tailShift:0},t)}return et(e,[{key:"aggregate",value:function(t){return this.rawInserted+=t.rawInserted,this.skip=this.skip||t.skip,this.inserted+=t.inserted,this.tailShift+=t.tailShift,this}},{key:"offset",get:function(){return this.tailShift+this.inserted.length}}]),e}(),mt=function(){function e(t){X(this,e),this._value="",this._update(t),this.isInitialized=!0}return et(e,[{key:"updateOptions",value:function(t){this.withValueRefresh(this._update.bind(this,t))}},{key:"_update",value:function(t){ut(this,t)}},{key:"reset",value:function(){this._value=""}},{key:"resolve",value:function(t){return this.reset(),this.append(t,{input:!0},{value:""}),this.doCommit(),this.value}},{key:"nearestInputPos",value:function(t,e){return t}},{key:"extractInput",value:function(){var t=0<arguments.length&&void 0!==arguments[0]?arguments[0]:0,e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:this.value.length;return this.value.slice(t,e)}},{key:"extractTail",value:function(){var t=0<arguments.length&&void 0!==arguments[0]?arguments[0]:0,e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:this.value.length;return{value:this.extractInput(t,e)}}},{key:"_storeBeforeTailState",value:function(){this._beforeTailState=this.state}},{key:"_restoreBeforeTailState",value:function(){this.state=this._beforeTailState}},{key:"_resetBeforeTailState",value:function(){this._beforeTailState=null}},{key:"appendTail",value:function(t){return this.append(t?t.value:"",{tail:!0})}},{key:"_appendCharRaw",value:function(t){return this._value+=t,new _t({inserted:t,rawInserted:t})}},{key:"_appendChar",value:function(t){var e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:{},n=2<arguments.length?arguments[2]:void 0;if(!(t=this.doPrepare(t,e)))return new _t;var u=this.state,i=this._appendCharRaw(t,e);if(i.inserted){var r=!1!==this.doValidate(e);if(r&&null!=n){this._storeBeforeTailState();var a=this.appendTail(n);(r=a.rawInserted===n.value)&&a.inserted&&this._restoreBeforeTailState()}r||(i.rawInserted=i.inserted="",this.state=u)}return i}},{key:"append",value:function(t,e,n){this.value.length;for(var u=new _t,i=0;i<t.length;++i)u.aggregate(this._appendChar(t[i],e,n));return null!=n&&(this._storeBeforeTailState(),u.tailShift+=this.appendTail(n).tailShift),u}},{key:"remove",value:function(){var t=0<arguments.length&&void 0!==arguments[0]?arguments[0]:0,e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:this.value.length;return this._value=this.value.slice(0,t)+this.value.slice(e),new _t}},{key:"withValueRefresh",value:function(t){if(this._refreshing||!this.isInitialized)return t();this._refreshing=!0;var e=this.unmaskedValue,n=this.value,u=t();return this.resolve(n)!==n&&(this.unmaskedValue=e),delete this._refreshing,u}},{key:"doPrepare",value:function(t){var e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:{};return this.prepare?this.prepare(t,this,e):t}},{key:"doValidate",value:function(t){return(!this.validate||this.validate(this.value,this,t))&&(!this.parent||this.parent.doValidate(t))}},{key:"doCommit",value:function(){this.commit&&this.commit(this.value,this)}},{key:"splice",value:function(t,e,n,u){var i=t+e,r=this.extractTail(i),a=this.nearestInputPos(t,u);return new _t({tailShift:a-t}).aggregate(this.remove(a)).aggregate(this.append(n,{input:!0},r))}},{key:"state",get:function(){return{_value:this.value}},set:function(t){this._value=t._value}},{key:"value",get:function(){return this._value},set:function(t){this.resolve(t)}},{key:"unmaskedValue",get:function(){return this.value},set:function(t){this.reset(),this.append(t,{},{value:""}),this.doCommit()}},{key:"typedValue",get:function(){return this.unmaskedValue},set:function(t){this.unmaskedValue=t}},{key:"rawInputValue",get:function(){return this.extractInput(0,this.value.length,{raw:!0})},set:function(t){this.reset(),this.append(t,{raw:!0},{value:""}),this.doCommit()}},{key:"isComplete",get:function(){return!0}}]),e}();function At(t){if(null==t)throw new Error("mask property should be defined");return t instanceof RegExp?gt.IMask.MaskedRegExp:"string"==typeof(e=t)||e instanceof String?gt.IMask.MaskedPattern:t instanceof Date||t===Date?gt.IMask.MaskedDate:t instanceof Number||"number"==typeof t||t===Number?gt.IMask.MaskedNumber:Array.isArray(t)||t===Array?gt.IMask.MaskedDynamic:t.prototype instanceof gt.IMask.Masked?t:t instanceof Function?gt.IMask.MaskedFunction:(console.warn("Mask not found for mask",t),gt.IMask.Masked);var e}function Ct(t){var e=(t=it({},t)).mask;return e instanceof gt.IMask.Masked?e:new(At(e))(t)}var Ft={0:/\d/,a:/[\u0041-\u005A\u0061-\u007A\u00AA\u00B5\u00BA\u00C0-\u00D6\u00D8-\u00F6\u00F8-\u02C1\u02C6-\u02D1\u02E0-\u02E4\u02EC\u02EE\u0370-\u0374\u0376\u0377\u037A-\u037D\u0386\u0388-\u038A\u038C\u038E-\u03A1\u03A3-\u03F5\u03F7-\u0481\u048A-\u0527\u0531-\u0556\u0559\u0561-\u0587\u05D0-\u05EA\u05F0-\u05F2\u0620-\u064A\u066E\u066F\u0671-\u06D3\u06D5\u06E5\u06E6\u06EE\u06EF\u06FA-\u06FC\u06FF\u0710\u0712-\u072F\u074D-\u07A5\u07B1\u07CA-\u07EA\u07F4\u07F5\u07FA\u0800-\u0815\u081A\u0824\u0828\u0840-\u0858\u08A0\u08A2-\u08AC\u0904-\u0939\u093D\u0950\u0958-\u0961\u0971-\u0977\u0979-\u097F\u0985-\u098C\u098F\u0990\u0993-\u09A8\u09AA-\u09B0\u09B2\u09B6-\u09B9\u09BD\u09CE\u09DC\u09DD\u09DF-\u09E1\u09F0\u09F1\u0A05-\u0A0A\u0A0F\u0A10\u0A13-\u0A28\u0A2A-\u0A30\u0A32\u0A33\u0A35\u0A36\u0A38\u0A39\u0A59-\u0A5C\u0A5E\u0A72-\u0A74\u0A85-\u0A8D\u0A8F-\u0A91\u0A93-\u0AA8\u0AAA-\u0AB0\u0AB2\u0AB3\u0AB5-\u0AB9\u0ABD\u0AD0\u0AE0\u0AE1\u0B05-\u0B0C\u0B0F\u0B10\u0B13-\u0B28\u0B2A-\u0B30\u0B32\u0B33\u0B35-\u0B39\u0B3D\u0B5C\u0B5D\u0B5F-\u0B61\u0B71\u0B83\u0B85-\u0B8A\u0B8E-\u0B90\u0B92-\u0B95\u0B99\u0B9A\u0B9C\u0B9E\u0B9F\u0BA3\u0BA4\u0BA8-\u0BAA\u0BAE-\u0BB9\u0BD0\u0C05-\u0C0C\u0C0E-\u0C10\u0C12-\u0C28\u0C2A-\u0C33\u0C35-\u0C39\u0C3D\u0C58\u0C59\u0C60\u0C61\u0C85-\u0C8C\u0C8E-\u0C90\u0C92-\u0CA8\u0CAA-\u0CB3\u0CB5-\u0CB9\u0CBD\u0CDE\u0CE0\u0CE1\u0CF1\u0CF2\u0D05-\u0D0C\u0D0E-\u0D10\u0D12-\u0D3A\u0D3D\u0D4E\u0D60\u0D61\u0D7A-\u0D7F\u0D85-\u0D96\u0D9A-\u0DB1\u0DB3-\u0DBB\u0DBD\u0DC0-\u0DC6\u0E01-\u0E30\u0E32\u0E33\u0E40-\u0E46\u0E81\u0E82\u0E84\u0E87\u0E88\u0E8A\u0E8D\u0E94-\u0E97\u0E99-\u0E9F\u0EA1-\u0EA3\u0EA5\u0EA7\u0EAA\u0EAB\u0EAD-\u0EB0\u0EB2\u0EB3\u0EBD\u0EC0-\u0EC4\u0EC6\u0EDC-\u0EDF\u0F00\u0F40-\u0F47\u0F49-\u0F6C\u0F88-\u0F8C\u1000-\u102A\u103F\u1050-\u1055\u105A-\u105D\u1061\u1065\u1066\u106E-\u1070\u1075-\u1081\u108E\u10A0-\u10C5\u10C7\u10CD\u10D0-\u10FA\u10FC-\u1248\u124A-\u124D\u1250-\u1256\u1258\u125A-\u125D\u1260-\u1288\u128A-\u128D\u1290-\u12B0\u12B2-\u12B5\u12B8-\u12BE\u12C0\u12C2-\u12C5\u12C8-\u12D6\u12D8-\u1310\u1312-\u1315\u1318-\u135A\u1380-\u138F\u13A0-\u13F4\u1401-\u166C\u166F-\u167F\u1681-\u169A\u16A0-\u16EA\u1700-\u170C\u170E-\u1711\u1720-\u1731\u1740-\u1751\u1760-\u176C\u176E-\u1770\u1780-\u17B3\u17D7\u17DC\u1820-\u1877\u1880-\u18A8\u18AA\u18B0-\u18F5\u1900-\u191C\u1950-\u196D\u1970-\u1974\u1980-\u19AB\u19C1-\u19C7\u1A00-\u1A16\u1A20-\u1A54\u1AA7\u1B05-\u1B33\u1B45-\u1B4B\u1B83-\u1BA0\u1BAE\u1BAF\u1BBA-\u1BE5\u1C00-\u1C23\u1C4D-\u1C4F\u1C5A-\u1C7D\u1CE9-\u1CEC\u1CEE-\u1CF1\u1CF5\u1CF6\u1D00-\u1DBF\u1E00-\u1F15\u1F18-\u1F1D\u1F20-\u1F45\u1F48-\u1F4D\u1F50-\u1F57\u1F59\u1F5B\u1F5D\u1F5F-\u1F7D\u1F80-\u1FB4\u1FB6-\u1FBC\u1FBE\u1FC2-\u1FC4\u1FC6-\u1FCC\u1FD0-\u1FD3\u1FD6-\u1FDB\u1FE0-\u1FEC\u1FF2-\u1FF4\u1FF6-\u1FFC\u2071\u207F\u2090-\u209C\u2102\u2107\u210A-\u2113\u2115\u2119-\u211D\u2124\u2126\u2128\u212A-\u212D\u212F-\u2139\u213C-\u213F\u2145-\u2149\u214E\u2183\u2184\u2C00-\u2C2E\u2C30-\u2C5E\u2C60-\u2CE4\u2CEB-\u2CEE\u2CF2\u2CF3\u2D00-\u2D25\u2D27\u2D2D\u2D30-\u2D67\u2D6F\u2D80-\u2D96\u2DA0-\u2DA6\u2DA8-\u2DAE\u2DB0-\u2DB6\u2DB8-\u2DBE\u2DC0-\u2DC6\u2DC8-\u2DCE\u2DD0-\u2DD6\u2DD8-\u2DDE\u2E2F\u3005\u3006\u3031-\u3035\u303B\u303C\u3041-\u3096\u309D-\u309F\u30A1-\u30FA\u30FC-\u30FF\u3105-\u312D\u3131-\u318E\u31A0-\u31BA\u31F0-\u31FF\u3400-\u4DB5\u4E00-\u9FCC\uA000-\uA48C\uA4D0-\uA4FD\uA500-\uA60C\uA610-\uA61F\uA62A\uA62B\uA640-\uA66E\uA67F-\uA697\uA6A0-\uA6E5\uA717-\uA71F\uA722-\uA788\uA78B-\uA78E\uA790-\uA793\uA7A0-\uA7AA\uA7F8-\uA801\uA803-\uA805\uA807-\uA80A\uA80C-\uA822\uA840-\uA873\uA882-\uA8B3\uA8F2-\uA8F7\uA8FB\uA90A-\uA925\uA930-\uA946\uA960-\uA97C\uA984-\uA9B2\uA9CF\uAA00-\uAA28\uAA40-\uAA42\uAA44-\uAA4B\uAA60-\uAA76\uAA7A\uAA80-\uAAAF\uAAB1\uAAB5\uAAB6\uAAB9-\uAABD\uAAC0\uAAC2\uAADB-\uAADD\uAAE0-\uAAEA\uAAF2-\uAAF4\uAB01-\uAB06\uAB09-\uAB0E\uAB11-\uAB16\uAB20-\uAB26\uAB28-\uAB2E\uABC0-\uABE2\uAC00-\uD7A3\uD7B0-\uD7C6\uD7CB-\uD7FB\uF900-\uFA6D\uFA70-\uFAD9\uFB00-\uFB06\uFB13-\uFB17\uFB1D\uFB1F-\uFB28\uFB2A-\uFB36\uFB38-\uFB3C\uFB3E\uFB40\uFB41\uFB43\uFB44\uFB46-\uFBB1\uFBD3-\uFD3D\uFD50-\uFD8F\uFD92-\uFDC7\uFDF0-\uFDFB\uFE70-\uFE74\uFE76-\uFEFC\uFF21-\uFF3A\uFF41-\uFF5A\uFF66-\uFFBE\uFFC2-\uFFC7\uFFCA-\uFFCF\uFFD2-\uFFD7\uFFDA-\uFFDC]/,"*":/./},Et=function(){function u(t){X(this,u);var e=t.mask,n=ot(t,["mask"]);this.masked=Ct({mask:e}),ut(this,n)}return et(u,[{key:"reset",value:function(){this._isFilled=!1,this.masked.reset()}},{key:"remove",value:function(){var t=0<arguments.length&&void 0!==arguments[0]?arguments[0]:0,e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:this.value.length;return 0===t&&1<=e?(this._isFilled=!1,this.masked.remove(t,e)):new _t}},{key:"_appendChar",value:function(t){var e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:{};if(this._isFilled)return new _t;var n=this.masked.state,u=this.masked._appendChar(t,e);return u.inserted&&!1===this.doValidate(e)&&(u.inserted=u.rawInserted="",this.masked.state=n),u.inserted||this.isOptional||this.lazy||e.input||(u.inserted=this.placeholderChar),u.skip=!u.inserted&&!this.isOptional,this._isFilled=Boolean(u.inserted),u}},{key:"_appendPlaceholder",value:function(){var t=new _t;return this._isFilled||this.isOptional||(this._isFilled=!0,t.inserted=this.placeholderChar),t}},{key:"extractTail",value:function(){var t;return(t=this.masked).extractTail.apply(t,arguments)}},{key:"appendTail",value:function(){var t;return(t=this.masked).appendTail.apply(t,arguments)}},{key:"extractInput",value:function(){var t=0<arguments.length&&void 0!==arguments[0]?arguments[0]:0,e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:this.value.length,n=2<arguments.length?arguments[2]:void 0;return this.masked.extractInput(t,e,n)}},{key:"nearestInputPos",value:function(t){var e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:vt.NONE,n=this.value.length,u=Math.min(Math.max(t,0),n);switch(e){case vt.LEFT:case vt.FORCE_LEFT:return this.isComplete?u:0;case vt.RIGHT:case vt.FORCE_RIGHT:return this.isComplete?u:n;case vt.NONE:default:return u}}},{key:"doValidate",value:function(){var t,e;return(t=this.masked).doValidate.apply(t,arguments)&&(!this.parent||(e=this.parent).doValidate.apply(e,arguments))}},{key:"doCommit",value:function(){this.masked.doCommit()}},{key:"value",get:function(){return this.masked.value||(this._isFilled&&!this.isOptional?this.placeholderChar:"")}},{key:"unmaskedValue",get:function(){return this.masked.unmaskedValue}},{key:"isComplete",get:function(){return Boolean(this.masked.value)||this.isOptional}},{key:"state",get:function(){return{masked:this.masked.state,_isFilled:this._isFilled}},set:function(t){this.masked.state=t.masked,this._isFilled=t._isFilled}}]),u}(),bt=function(){function e(t){X(this,e),ut(this,t),this._value=""}return et(e,[{key:"reset",value:function(){this._isRawInput=!1,this._value=""}},{key:"remove",value:function(){var t=0<arguments.length&&void 0!==arguments[0]?arguments[0]:0,e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:this._value.length;return this._value=this._value.slice(0,t)+this._value.slice(e),this._value||(this._isRawInput=!1),new _t}},{key:"nearestInputPos",value:function(t){var e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:vt.NONE,n=this._value.length;switch(e){case vt.LEFT:case vt.FORCE_LEFT:return 0;case vt.NONE:case vt.RIGHT:case vt.FORCE_RIGHT:default:return n}}},{key:"extractInput",value:function(){var t=0<arguments.length&&void 0!==arguments[0]?arguments[0]:0,e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:this._value.length;return(2<arguments.length&&void 0!==arguments[2]?arguments[2]:{}).raw&&this._isRawInput&&this._value.slice(t,e)||""}},{key:"_appendChar",value:function(t,e){var n=new _t;if(this._value)return n;var u=this.char===t[0]&&(this.isUnmasking||e.input||e.raw)&&!e.tail;return u&&(n.rawInserted=this.char),this._value=n.inserted=this.char,this._isRawInput=u&&(e.raw||e.input),n}},{key:"_appendPlaceholder",value:function(){var t=new _t;return this._value||(this._value=t.inserted=this.char),t}},{key:"extractTail",value:function(){1<arguments.length&&void 0!==arguments[1]?arguments[1]:this.value.length;return{value:""}}},{key:"appendTail",value:function(t){return this._appendChar(t?t.value:"",{tail:!0})}},{key:"doCommit",value:function(){}},{key:"value",get:function(){return this._value}},{key:"unmaskedValue",get:function(){return this.isUnmasking?this.value:""}},{key:"isComplete",get:function(){return!0}},{key:"state",get:function(){return{_value:this._value,_isRawInput:this._isRawInput}},set:function(t){ut(this,t)}}]),e}(),Bt=function(){function e(t){X(this,e),this.chunks=t}return et(e,[{key:"value",get:function(){return this.chunks.map(function(t){return t.value}).join("")}}]),e}(),St=function(t){function l(){var t=0<arguments.length&&void 0!==arguments[0]?arguments[0]:{};return X(this,l),t.definitions=ut({},Ft,t.definitions),lt(this,at(l).call(this,it({},l.DEFAULTS,t)))}return rt(l,mt),et(l,[{key:"_update",value:function(){var t=0<arguments.length&&void 0!==arguments[0]?arguments[0]:{};t.definitions=ut({},this.definitions,t.definitions),ct(at(l.prototype),"_update",this).call(this,t),this._rebuildMask()}},{key:"_rebuildMask",value:function(){var i=this,t=this.definitions;this._blocks=[],this._stops=[],this._maskedBlocks={};var r=this.mask;if(r&&t)for(var e=!1,n=!1,a=0;a<r.length;++a){if(this.blocks)if("continue"===function(){var e=r.slice(a),t=Object.keys(i.blocks).filter(function(t){return 0===e.indexOf(t)});t.sort(function(t,e){return e.length-t.length});var n=t[0];if(n){var u=Ct(it({parent:i,lazy:i.lazy,placeholderChar:i.placeholderChar},i.blocks[n]));return u&&(i._blocks.push(u),i._maskedBlocks[n]||(i._maskedBlocks[n]=[]),i._maskedBlocks[n].push(i._blocks.length-1)),a+=n.length-1,"continue"}}())continue;var u=r[a],s=u in t;if(u!==l.STOP_CHAR)if("{"!==u&&"}"!==u)if("["!==u&&"]"!==u){if(u===l.ESCAPE_CHAR){if(!(u=r[++a]))break;s=!1}var o=void 0;o=s?new Et({parent:this,lazy:this.lazy,placeholderChar:this.placeholderChar,mask:t[u],isOptional:n}):new bt({char:u,isUnmasking:e}),this._blocks.push(o)}else n=!n;else e=!e;else this._stops.push(this._blocks.length)}}},{key:"_storeBeforeTailState",value:function(){this._blocks.forEach(function(t){"function"==typeof t._storeBeforeTailState&&t._storeBeforeTailState()}),ct(at(l.prototype),"_storeBeforeTailState",this).call(this)}},{key:"_restoreBeforeTailState",value:function(){this._blocks.forEach(function(t){"function"==typeof t._restoreBeforeTailState&&t._restoreBeforeTailState()}),ct(at(l.prototype),"_restoreBeforeTailState",this).call(this)}},{key:"_resetBeforeTailState",value:function(){this._blocks.forEach(function(t){"function"==typeof t._resetBeforeTailState&&t._resetBeforeTailState()}),ct(at(l.prototype),"_resetBeforeTailState",this).call(this)}},{key:"reset",value:function(){ct(at(l.prototype),"reset",this).call(this),this._blocks.forEach(function(t){return t.reset()})}},{key:"doCommit",value:function(){this._blocks.forEach(function(t){return t.doCommit()}),ct(at(l.prototype),"doCommit",this).call(this)}},{key:"appendTail",value:function(t){var e=new _t;return t&&e.aggregate(t instanceof Bt?this._appendTailChunks(t.chunks):ct(at(l.prototype),"appendTail",this).call(this,t)),e.aggregate(this._appendPlaceholder())}},{key:"_appendCharRaw",value:function(t){var e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:{},n=this._mapPosToBlock(this.value.length),u=new _t;if(!n)return u;for(var i=n.index;;++i){var r=this._blocks[i];if(!r)break;var a=r._appendChar(t,e),s=a.skip;if(u.aggregate(a),s||a.rawInserted)break}return u}},{key:"_appendTailChunks",value:function(t){for(var e=new _t,n=0;n<t.length&&!e.skip;++n){var u=t[n],i=this._mapPosToBlock(this.value.length),r=u instanceof Bt&&null!=u.index&&(!i||i.index<=u.index)&&this._blocks[u.index];if(r){e.aggregate(this._appendPlaceholder(u.index));var a=r.appendTail(u);a.skip=!1,e.aggregate(a),this._value+=a.inserted;var s=u.value.slice(a.rawInserted.length);s&&e.aggregate(this.append(s,{tail:!0}))}else{var o=u,l=o.stop,h=o.value;null!=l&&0<=this._stops.indexOf(l)&&e.aggregate(this._appendPlaceholder(l)),e.aggregate(this.append(h,{tail:!0}))}}return e}},{key:"extractTail",value:function(){var t=0<arguments.length&&void 0!==arguments[0]?arguments[0]:0,e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:this.value.length;return new Bt(this._extractTailChunks(t,e))}},{key:"extractInput",value:function(){var t=0<arguments.length&&void 0!==arguments[0]?arguments[0]:0,e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:this.value.length,i=2<arguments.length&&void 0!==arguments[2]?arguments[2]:{};if(t===e)return"";var r="";return this._forEachBlocksInRange(t,e,function(t,e,n,u){r+=t.extractInput(n,u,i)}),r}},{key:"_extractTailChunks",value:function(){var h=this,t=0<arguments.length&&void 0!==arguments[0]?arguments[0]:0,e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:this.value.length;if(t===e)return[];var c,f=[];return this._forEachBlocksInRange(t,e,function(t,e,n,u){for(var i,r=t.extractTail(n,u),a=0;a<h._stops.length;++a){var s=h._stops[a];if(!(s<=e))break;i=s}if(r instanceof Bt){if(null==i){for(var o=r.chunks.length,l=0;l<r.chunks.length;++l)if(null!=r.chunks[l].stop){o=l;break}r.chunks.splice(0,o).filter(function(t){return t.value}).forEach(function(t){c?c.value+=t.value:c={value:t.value}})}r.chunks.length&&(c&&f.push(c),r.index=i,f.push(r),c=null)}else{if(null!=i)c&&f.push(c),r.stop=i;else if(c)return void(c.value+=r.value);c=r}}),c&&c.value&&f.push(c),f}},{key:"_appendPlaceholder",value:function(t){var u=this,i=new _t;if(this.lazy&&null==t)return i;var e=this._mapPosToBlock(this.value.length);if(!e)return i;var n=e.index,r=null!=t?t:this._blocks.length;return this._blocks.slice(n,r).forEach(function(t){if("function"==typeof t._appendPlaceholder){var e=null!=t._blocks?[t._blocks.length]:[],n=t._appendPlaceholder.apply(t,e);u._value+=n.inserted,i.aggregate(n)}}),i}},{key:"_mapPosToBlock",value:function(t){for(var e="",n=0;n<this._blocks.length;++n){var u=this._blocks[n],i=e.length;if(t<=(e+=u.value).length)return{index:n,offset:t-i}}}},{key:"_blockStartPos",value:function(t){return this._blocks.slice(0,t).reduce(function(t,e){return t+e.value.length},0)}},{key:"_forEachBlocksInRange",value:function(t){var e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:this.value.length,n=2<arguments.length?arguments[2]:void 0,u=this._mapPosToBlock(t);if(u){var i=this._mapPosToBlock(e),r=i&&u.index===i.index,a=u.offset,s=i&&r?i.offset:void 0;if(n(this._blocks[u.index],u.index,a,s),i&&!r){for(var o=u.index+1;o<i.index;++o)n(this._blocks[o],o);n(this._blocks[i.index],i.index,0,i.offset)}}}},{key:"remove",value:function(){var t=0<arguments.length&&void 0!==arguments[0]?arguments[0]:0,e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:this.value.length,i=ct(at(l.prototype),"remove",this).call(this,t,e);return this._forEachBlocksInRange(t,e,function(t,e,n,u){i.aggregate(t.remove(n,u))}),i}},{key:"nearestInputPos",value:function(t){var e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:vt.NONE,n=this._mapPosToBlock(t)||{index:0,offset:0},u=n.offset,i=n.index,r=this._blocks[i];if(!r)return t;var a=u;0!==a&&a<r.value.length&&(a=r.nearestInputPos(u,function(t){switch(t){case vt.LEFT:return vt.FORCE_LEFT;case vt.RIGHT:return vt.FORCE_RIGHT;default:return t}}(e)));var s=a===r.value.length;if(!(0===a)&&!s)return this._blockStartPos(i)+a;var o=s?i+1:i;if(e===vt.NONE){if(0<o){var l=o-1,h=this._blocks[l],c=h.nearestInputPos(0,vt.NONE);if(!h.value.length||c!==h.value.length)return this._blockStartPos(o)}for(var f=o;f<this._blocks.length;++f){var p=this._blocks[f],d=p.nearestInputPos(0,vt.NONE);if(d!==p.value.length)return this._blockStartPos(f)+d}return this.value.length}if(e===vt.LEFT||e===vt.FORCE_LEFT){for(var v,k=o;k<this._blocks.length;++k)if(this._blocks[k].value){v=k;break}if(null!=v){var g=this._blocks[v],y=g.nearestInputPos(0,vt.RIGHT);if(0===y&&g.unmaskedValue.length)return this._blockStartPos(v)+y}for(var _,m=-1,A=o-1;0<=A;--A){var C=this._blocks[A],F=C.nearestInputPos(C.value.length,vt.FORCE_LEFT);if(null!=_||C.value&&0===F||(_=A),0!==F){if(F!==C.value.length)return this._blockStartPos(A)+F;m=A;break}}if(e===vt.LEFT)for(var E=m+1;E<=Math.min(o,this._blocks.length-1);++E){var b=this._blocks[E],B=b.nearestInputPos(0,vt.NONE),S=this._blockStartPos(E)+B;if((!b.value.length&&S===this.value.length||B!==b.value.length)&&S<=t)return S}if(0<=m)return this._blockStartPos(m)+this._blocks[m].value.length;if(e===vt.FORCE_LEFT||this.lazy&&!this.extractInput()&&!function(t){if(!t)return!1;var e=t.value;return!e||t.nearestInputPos(0,vt.NONE)!==e.length}(this._blocks[o]))return 0;if(null!=_)return this._blockStartPos(_);for(var D=o;D<this._blocks.length;++D){var T=this._blocks[D],w=T.nearestInputPos(0,vt.NONE);if(!T.value.length||w!==T.value.length)return this._blockStartPos(D)+w}return 0}if(e===vt.RIGHT||e===vt.FORCE_RIGHT){for(var x,M,P=o;P<this._blocks.length;++P){var O=this._blocks[P],I=O.nearestInputPos(0,vt.NONE);if(I!==O.value.length){M=this._blockStartPos(P)+I,x=P;break}}if(null!=x&&null!=M){for(var R=x;R<this._blocks.length;++R){var V=this._blocks[R],j=V.nearestInputPos(0,vt.FORCE_RIGHT);if(j!==V.value.length)return this._blockStartPos(R)+j}return e===vt.FORCE_RIGHT?this.value.length:M}for(var N=Math.min(o,this._blocks.length-1);0<=N;--N){var L=this._blocks[N],H=L.nearestInputPos(L.value.length,vt.LEFT);if(0!==H){var G=this._blockStartPos(N)+H;if(t<=G)return G;break}}}return t}},{key:"maskedBlock",value:function(t){return this.maskedBlocks(t)[0]}},{key:"maskedBlocks",value:function(t){var e=this,n=this._maskedBlocks[t];return n?n.map(function(t){return e._blocks[t]}):[]}},{key:"state",get:function(){return it({},ct(at(l.prototype),"state",this),{_blocks:this._blocks.map(function(t){return t.state})})},set:function(t){var n=t._blocks,e=ot(t,["_blocks"]);this._blocks.forEach(function(t,e){return t.state=n[e]}),pt(at(l.prototype),"state",e,this,!0)}},{key:"isComplete",get:function(){return this._blocks.every(function(t){return t.isComplete})}},{key:"unmaskedValue",get:function(){return this._blocks.reduce(function(t,e){return t+e.unmaskedValue},"")},set:function(t){pt(at(l.prototype),"unmaskedValue",t,this,!0)}},{key:"value",get:function(){return this._blocks.reduce(function(t,e){return t+e.value},"")},set:function(t){pt(at(l.prototype),"value",t,this,!0)}}]),l}();St.DEFAULTS={lazy:!0,placeholderChar:"_"},St.STOP_CHAR="`",St.ESCAPE_CHAR="\\",St.InputDefinition=Et,St.FixedDefinition=bt;var Dt=function(t){function h(){return X(this,h),lt(this,at(h).apply(this,arguments))}return rt(h,St),et(h,[{key:"_update",value:function(t){var e=String(t.to).length;null!=t.maxLength&&(e=Math.max(e,t.maxLength)),t.maxLength=e;for(var n=String(t.to).padStart(e,"0"),u=String(t.from).padStart(e,"0"),i=0;i<n.length&&n[i]===u[i];)++i;t.mask=n.slice(0,i).replace(/0/g,"\\0")+"0".repeat(e-i),ct(at(h.prototype),"_update",this).call(this,t)}},{key:"doValidate",value:function(){var t,e=this.value,n="",u="",i=dt(e.match(/^(\D*)(\d*)(\D*)/)||[],3),r=i[1],a=i[2];if(a&&(n="0".repeat(r.length)+a,u="9".repeat(r.length)+a),-1===e.search(/[^0]/)&&e.length<=this._matchFrom)return!0;n=n.padEnd(this.maxLength,"0"),u=u.padEnd(this.maxLength,"9");for(var s=arguments.length,o=new Array(s),l=0;l<s;l++)o[l]=arguments[l];return this.from<=Number(u)&&Number(n)<=this.to&&(t=ct(at(h.prototype),"doValidate",this)).call.apply(t,[this].concat(o))}},{key:"_matchFrom",get:function(){return this.maxLength-String(this.from).length}},{key:"isComplete",get:function(){return ct(at(h.prototype),"isComplete",this)&&Boolean(this.value)}}]),h}(),Tt=function(t){function r(t){return X(this,r),lt(this,at(r).call(this,it({},r.DEFAULTS,t)))}return rt(r,St),et(r,[{key:"_update",value:function(t){t.mask===Date&&delete t.mask,t.pattern&&(t.mask=t.pattern,delete t.pattern);var e=t.blocks;t.blocks=ut({},r.GET_DEFAULT_BLOCKS()),t.min&&(t.blocks.Y.from=t.min.getFullYear()),t.max&&(t.blocks.Y.to=t.max.getFullYear()),t.min&&t.max&&t.blocks.Y.from===t.blocks.Y.to&&(t.blocks.m.from=t.min.getMonth()+1,t.blocks.m.to=t.max.getMonth()+1,t.blocks.m.from===t.blocks.m.to&&(t.blocks.d.from=t.min.getDate(),t.blocks.d.to=t.max.getDate())),ut(t.blocks,e),ct(at(r.prototype),"_update",this).call(this,t)}},{key:"doValidate",value:function(){for(var t,e=this.date,n=arguments.length,u=new Array(n),i=0;i<n;i++)u[i]=arguments[i];return(t=ct(at(r.prototype),"doValidate",this)).call.apply(t,[this].concat(u))&&(!this.isComplete||this.isDateExist(this.value)&&null!=e&&(null==this.min||this.min<=e)&&(null==this.max||e<=this.max))}},{key:"isDateExist",value:function(t){return this.format(this.parse(t))===t}},{key:"date",get:function(){return this.isComplete?this.parse(this.value):null},set:function(t){this.value=this.format(t)}},{key:"typedValue",get:function(){return this.date},set:function(t){this.date=t}}]),r}();Tt.DEFAULTS={pattern:"d{.}`m{.}`Y",format:function(t){return[String(t.getDate()).padStart(2,"0"),String(t.getMonth()+1).padStart(2,"0"),t.getFullYear()].join(".")},parse:function(t){var e=dt(t.split("."),3),n=e[0],u=e[1],i=e[2];return new Date(i,u-1,n)}},Tt.GET_DEFAULT_BLOCKS=function(){return{d:{mask:Dt,from:1,to:31,maxLength:2},m:{mask:Dt,from:1,to:12,maxLength:2},Y:{mask:Dt,from:1900,to:9999}}};var wt=function(){function t(){X(this,t)}return et(t,[{key:"select",value:function(t,e){if(null!=t&&null!=e&&(t!==this.selectionStart||e!==this.selectionEnd))try{this._unsafeSelect(t,e)}catch(t){}}},{key:"_unsafeSelect",value:function(t,e){}},{key:"bindEvents",value:function(t){}},{key:"unbindEvents",value:function(){}},{key:"selectionStart",get:function(){var t;try{t=this._unsafeSelectionStart}catch(t){}return null!=t?t:this.value.length}},{key:"selectionEnd",get:function(){var t;try{t=this._unsafeSelectionEnd}catch(t){}return null!=t?t:this.value.length}},{key:"isActive",get:function(){return!1}}]),t}(),xt=function(t){function u(t){var e;return X(this,u),(e=lt(this,at(u).call(this))).input=t,e._handlers={},e}return rt(u,wt),et(u,[{key:"_unsafeSelect",value:function(t,e){this.input.setSelectionRange(t,e)}},{key:"bindEvents",value:function(e){var n=this;Object.keys(e).forEach(function(t){return n._toggleEventHandler(u.EVENTS_MAP[t],e[t])})}},{key:"unbindEvents",value:function(){var e=this;Object.keys(this._handlers).forEach(function(t){return e._toggleEventHandler(t)})}},{key:"_toggleEventHandler",value:function(t,e){this._handlers[t]&&(this.input.removeEventListener(t,this._handlers[t]),delete this._handlers[t]),e&&(this.input.addEventListener(t,e),this._handlers[t]=e)}},{key:"isActive",get:function(){return this.input===document.activeElement}},{key:"_unsafeSelectionStart",get:function(){return this.input.selectionStart}},{key:"_unsafeSelectionEnd",get:function(){return this.input.selectionEnd}},{key:"value",get:function(){return this.input.value},set:function(t){this.input.value=t}}]),u}();xt.EVENTS_MAP={selectionChange:"keydown",input:"input",drop:"drop",click:"click",focus:"focus",commit:"change"};var Mt=function(){function n(t,e){X(this,n),this.el=t instanceof wt?t:new xt(t),this.masked=Ct(e),this._listeners={},this._value="",this._unmaskedValue="",this._saveSelection=this._saveSelection.bind(this),this._onInput=this._onInput.bind(this),this._onChange=this._onChange.bind(this),this._onDrop=this._onDrop.bind(this),this.alignCursor=this.alignCursor.bind(this),this.alignCursorFriendly=this.alignCursorFriendly.bind(this),this._bindEvents(),this.updateValue(),this._onChange()}return et(n,[{key:"_bindEvents",value:function(){this.el.bindEvents({selectionChange:this._saveSelection,input:this._onInput,drop:this._onDrop,click:this.alignCursorFriendly,focus:this.alignCursorFriendly,commit:this._onChange})}},{key:"_unbindEvents",value:function(){this.el.unbindEvents()}},{key:"_fireEvent",value:function(t){var e=this._listeners[t];e&&e.forEach(function(t){return t()})}},{key:"_saveSelection",value:function(){this.value!==this.el.value&&console.warn("Element value was changed outside of mask. Syncronize mask using `mask.updateValue()` to work properly."),this._selection={start:this.selectionStart,end:this.cursorPos}}},{key:"updateValue",value:function(){this.masked.value=this.el.value}},{key:"updateControl",value:function(){var t=this.masked.unmaskedValue,e=this.masked.value,n=this.unmaskedValue!==t||this.value!==e;this._unmaskedValue=t,this._value=e,this.el.value!==e&&(this.el.value=e),n&&this._fireChangeEvents()}},{key:"updateOptions",value:function(t){t=it({},t),this.mask=t.mask,delete t.mask,function t(e,n){if(n===e)return!0;var u,i=Array.isArray(n),r=Array.isArray(e);if(i&&r){if(n.length!=e.length)return!1;for(u=0;u<n.length;u++)if(!t(n[u],e[u]))return!1;return!0}if(i!=r)return!1;if(n&&e&&"object"===Q(n)&&"object"===Q(e)){var a=n instanceof Date,s=e instanceof Date;if(a&&s)return n.getTime()==e.getTime();if(a!=s)return!1;var o=n instanceof RegExp,l=e instanceof RegExp;if(o&&l)return n.toString()==e.toString();if(o!=l)return!1;var h=Object.keys(n);for(u=0;u<h.length;u++)if(!Object.prototype.hasOwnProperty.call(e,h[u]))return!1;for(u=0;u<h.length;u++)if(!t(e[h[u]],n[h[u]]))return!1;return!0}return!1}(this.masked,t)||this.masked.updateOptions(t),this.updateControl()}},{key:"updateCursor",value:function(t){null!=t&&(this.cursorPos=t,this._delayUpdateCursor(t))}},{key:"_delayUpdateCursor",value:function(t){var e=this;this._abortUpdateCursor(),this._changingCursorPos=t,this._cursorChanging=setTimeout(function(){e.el&&(e.cursorPos=e._changingCursorPos,e._abortUpdateCursor())},10)}},{key:"_fireChangeEvents",value:function(){this._fireEvent("accept"),this.masked.isComplete&&this._fireEvent("complete")}},{key:"_abortUpdateCursor",value:function(){this._cursorChanging&&(clearTimeout(this._cursorChanging),delete this._cursorChanging)}},{key:"alignCursor",value:function(){this.cursorPos=this.masked.nearestInputPos(this.cursorPos,vt.LEFT)}},{key:"alignCursorFriendly",value:function(){this.selectionStart===this.cursorPos&&this.alignCursor()}},{key:"on",value:function(t,e){return this._listeners[t]||(this._listeners[t]=[]),this._listeners[t].push(e),this}},{key:"off",value:function(t,e){if(this._listeners[t]){if(e){var n=this._listeners[t].indexOf(e);return 0<=n&&this._listeners[t].splice(n,1),this}delete this._listeners[t]}}},{key:"_onInput",value:function(){if(this._abortUpdateCursor(),!this._selection)return this.updateValue();var t=new yt(this.el.value,this.cursorPos,this.value,this._selection),e=this.masked.splice(t.startChangePos,t.removed.length,t.inserted,t.removeDirection).offset,n=this.masked.nearestInputPos(t.startChangePos+e,t.removeDirection);this.updateControl(),this.updateCursor(n)}},{key:"_onChange",value:function(){this.value!==this.el.value&&this.updateValue(),this.masked.doCommit(),this.updateControl()}},{key:"_onDrop",value:function(t){t.preventDefault(),t.stopPropagation()}},{key:"destroy",value:function(){this._unbindEvents(),this._listeners.length=0,delete this.el}},{key:"mask",get:function(){return this.masked.mask},set:function(t){if(!(null==t||t===this.masked.mask||t===Date&&this.masked instanceof Tt))if(this.masked.constructor!==At(t)){var e=Ct({mask:t});e.unmaskedValue=this.masked.unmaskedValue,this.masked=e}else this.masked.updateOptions({mask:t})}},{key:"value",get:function(){return this._value},set:function(t){this.masked.value=t,this.updateControl(),this.alignCursor()}},{key:"unmaskedValue",get:function(){return this._unmaskedValue},set:function(t){this.masked.unmaskedValue=t,this.updateControl(),this.alignCursor()}},{key:"typedValue",get:function(){return this.masked.typedValue},set:function(t){this.masked.typedValue=t,this.updateControl(),this.alignCursor()}},{key:"selectionStart",get:function(){return this._cursorChanging?this._changingCursorPos:this.el.selectionStart}},{key:"cursorPos",get:function(){return this._cursorChanging?this._changingCursorPos:this.el.selectionEnd},set:function(t){this.el.isActive&&(this.el.select(t,t),this._saveSelection())}}]),n}(),Pt=function(t){function r(){return X(this,r),lt(this,at(r).apply(this,arguments))}return rt(r,St),et(r,[{key:"_update",value:function(t){t.enum&&(t.mask="*".repeat(t.enum[0].length)),ct(at(r.prototype),"_update",this).call(this,t)}},{key:"doValidate",value:function(){for(var t,e=this,n=arguments.length,u=new Array(n),i=0;i<n;i++)u[i]=arguments[i];return this.enum.some(function(t){return 0<=t.indexOf(e.unmaskedValue)})&&(t=ct(at(r.prototype),"doValidate",this)).call.apply(t,[this].concat(u))}}]),r}(),Ot=function(t){function r(t){return X(this,r),lt(this,at(r).call(this,it({},r.DEFAULTS,t)))}return rt(r,mt),et(r,[{key:"_update",value:function(t){ct(at(r.prototype),"_update",this).call(this,t),this._updateRegExps()}},{key:"_updateRegExps",value:function(){var t="",e="";this.allowNegative?(t+="([+|\\-]?|([+|\\-]?(0|([1-9]+\\d*))))",e+="[+|\\-]?"):t+="(0|([1-9]+\\d*))",e+="\\d*";var n=(this.scale?"("+this.radix+"\\d{0,"+this.scale+"})?":"")+"$";this._numberRegExpInput=new RegExp("^"+t+n),this._numberRegExp=new RegExp("^"+e+n),this._mapToRadixRegExp=new RegExp("["+this.mapToRadix.map(kt).join("")+"]","g"),this._thousandsSeparatorRegExp=new RegExp(kt(this.thousandsSeparator),"g")}},{key:"extractTail",value:function(){var t=0<arguments.length&&void 0!==arguments[0]?arguments[0]:0,e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:this.value.length,n=ct(at(r.prototype),"extractTail",this).call(this,t,e);return it({},n,{value:this._removeThousandsSeparators(n.value)})}},{key:"_removeThousandsSeparators",value:function(t){return t.replace(this._thousandsSeparatorRegExp,"")}},{key:"_insertThousandsSeparators",value:function(t){var e=t.split(this.radix);return e[0]=e[0].replace(/\B(?=(\d{3})+(?!\d))/g,this.thousandsSeparator),e.join(this.radix)}},{key:"doPrepare",value:function(t){for(var e,n=arguments.length,u=new Array(1<n?n-1:0),i=1;i<n;i++)u[i-1]=arguments[i];return(e=ct(at(r.prototype),"doPrepare",this)).call.apply(e,[this,this._removeThousandsSeparators(t.replace(this._mapToRadixRegExp,this.radix))].concat(u))}},{key:"_separatorsCount",value:function(){for(var t=0<arguments.length&&void 0!==arguments[0]?arguments[0]:this._value,e=this._removeThousandsSeparators(t).length,n=e,u=0;u<=n;++u)this._value[u]===this.thousandsSeparator&&++n;return n-e}},{key:"_appendCharRaw",value:function(t){var e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:{};if(!this.thousandsSeparator)return ct(at(r.prototype),"_appendCharRaw",this).call(this,t,e);var n=this._separatorsCount(e.tail&&this._beforeTailState?this._beforeTailState._value:this._value);this._value=this._removeThousandsSeparators(this.value);var u=ct(at(r.prototype),"_appendCharRaw",this).call(this,t,e);this._value=this._insertThousandsSeparators(this._value);var i=this._separatorsCount(e.tail&&this._beforeTailState?this._beforeTailState._value:this._value);return u.tailShift+=i-n,u}},{key:"remove",value:function(){var t=0<arguments.length&&void 0!==arguments[0]?arguments[0]:0,e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:this.value.length,n=this.value.slice(0,t),u=this.value.slice(e),i=this._separatorsCount(n);this._value=this._insertThousandsSeparators(this._removeThousandsSeparators(n+u));var r=this._separatorsCount(n);return new _t({tailShift:r-i})}},{key:"nearestInputPos",value:function(t,e){if(!e)return t;var n,u=(n=t,e===vt.LEFT&&--n,n);return this.value[u]===this.thousandsSeparator&&(t=function(t,e){switch(e){case vt.LEFT:return--t;case vt.RIGHT:case vt.FORCE_RIGHT:return++t;default:return t}}(t,e)),t}},{key:"doValidate",value:function(t){var e=(t.input?this._numberRegExpInput:this._numberRegExp).test(this._removeThousandsSeparators(this.value));if(e){var n=this.number;e=e&&!isNaN(n)&&(null==this.min||0<=this.min||this.min<=this.number)&&(null==this.max||this.max<=0||this.number<=this.max)}return e&&ct(at(r.prototype),"doValidate",this).call(this,t)}},{key:"doCommit",value:function(){var t=this.number,e=t;null!=this.min&&(e=Math.max(e,this.min)),null!=this.max&&(e=Math.min(e,this.max)),e!==t&&(this.unmaskedValue=String(e));var n=this.value;this.normalizeZeros&&(n=this._normalizeZeros(n)),this.padFractionalZeros&&(n=this._padFractionalZeros(n)),this._value=this._insertThousandsSeparators(n),ct(at(r.prototype),"doCommit",this).call(this)}},{key:"_normalizeZeros",value:function(t){var e=this._removeThousandsSeparators(t).split(this.radix);return e[0]=e[0].replace(/^(\D*)(0*)(\d*)/,function(t,e,n,u){return e+u}),t.length&&!/\d$/.test(e[0])&&(e[0]=e[0]+"0"),1<e.length&&(e[1]=e[1].replace(/0*$/,""),e[1].length||(e.length=1)),this._insertThousandsSeparators(e.join(this.radix))}},{key:"_padFractionalZeros",value:function(t){if(!t)return t;var e=t.split(this.radix);return e.length<2&&e.push(""),e[1]=e[1].padEnd(this.scale,"0"),e.join(this.radix)}},{key:"unmaskedValue",get:function(){return this._removeThousandsSeparators(this._normalizeZeros(this.value)).replace(this.radix,".")},set:function(t){pt(at(r.prototype),"unmaskedValue",t.replace(".",this.radix),this,!0)}},{key:"number",get:function(){return Number(this.unmaskedValue)},set:function(t){this.unmaskedValue=String(t)}},{key:"typedValue",get:function(){return this.number},set:function(t){this.number=t}},{key:"allowNegative",get:function(){return this.signed||null!=this.min&&this.min<0||null!=this.max&&this.max<0}}]),r}();Ot.DEFAULTS={radix:",",thousandsSeparator:"",mapToRadix:["."],scale:2,signed:!1,normalizeZeros:!0,padFractionalZeros:!1};var It=function(t){function n(){return X(this,n),lt(this,at(n).apply(this,arguments))}return rt(n,mt),et(n,[{key:"_update",value:function(e){e.validate=function(t){return 0<=t.search(e.mask)},ct(at(n.prototype),"_update",this).call(this,e)}}]),n}(),Rt=function(t){function e(){return X(this,e),lt(this,at(e).apply(this,arguments))}return rt(e,mt),et(e,[{key:"_update",value:function(t){t.validate=t.mask,ct(at(e.prototype),"_update",this).call(this,t)}}]),e}(),Vt=function(t){function r(t){var e;return X(this,r),(e=lt(this,at(r).call(this,it({},r.DEFAULTS,t)))).currentMask=null,e}return rt(r,mt),et(r,[{key:"_update",value:function(t){ct(at(r.prototype),"_update",this).call(this,t),this.compiledMasks=Array.isArray(t.mask)?t.mask.map(function(t){return Ct(t)}):[]}},{key:"_appendCharRaw",value:function(){var t,e=this._applyDispatch.apply(this,arguments);this.currentMask&&e.aggregate((t=this.currentMask)._appendChar.apply(t,arguments));return e}},{key:"_storeBeforeTailState",value:function(){ct(at(r.prototype),"_storeBeforeTailState",this).call(this),this.currentMask&&this.currentMask._storeBeforeTailState()}},{key:"_restoreBeforeTailState",value:function(){ct(at(r.prototype),"_restoreBeforeTailState",this).call(this),this.currentMask&&this.currentMask._restoreBeforeTailState()}},{key:"_resetBeforeTailState",value:function(){ct(at(r.prototype),"_resetBeforeTailState",this).call(this),this.currentMask&&this.currentMask._resetBeforeTailState()}},{key:"_applyDispatch",value:function(){var t=0<arguments.length&&void 0!==arguments[0]?arguments[0]:"",e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:{},n=e.tail&&this._beforeTailState?this._beforeTailState._value:this.value,u=this.rawInputValue,i=e.tail&&this._beforeTailState?this._beforeTailState._rawInputValue:u,r=u.slice(i.length),a=this.currentMask,s=new _t;if(this.currentMask=this.doDispatch(t,e),this.currentMask&&this.currentMask!==a){this.currentMask.reset();var o=this.currentMask.append(i,{raw:!0});s.tailShift=o.inserted.length-n.length,this._storeBeforeTailState(),r&&(s.tailShift+=this.currentMask.append(r,{raw:!0,tail:!0}).tailShift)}return s}},{key:"doDispatch",value:function(t){var e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:{};return this.dispatch(t,this,e)}},{key:"doValidate",value:function(){for(var t,e,n=arguments.length,u=new Array(n),i=0;i<n;i++)u[i]=arguments[i];return(t=ct(at(r.prototype),"doValidate",this)).call.apply(t,[this].concat(u))&&(!this.currentMask||(e=this.currentMask).doValidate.apply(e,u))}},{key:"reset",value:function(){this.currentMask&&this.currentMask.reset(),this.compiledMasks.forEach(function(t){return t.reset()})}},{key:"remove",value:function(){var t,e=new _t;this.currentMask&&e.aggregate((t=this.currentMask).remove.apply(t,arguments)).aggregate(this._applyDispatch());return e}},{key:"extractInput",value:function(){var t;return this.currentMask?(t=this.currentMask).extractInput.apply(t,arguments):""}},{key:"extractTail",value:function(){for(var t,e,n=arguments.length,u=new Array(n),i=0;i<n;i++)u[i]=arguments[i];return this.currentMask?(t=this.currentMask).extractTail.apply(t,u):(e=ct(at(r.prototype),"extractTail",this)).call.apply(e,[this].concat(u))}},{key:"doCommit",value:function(){this.currentMask&&this.currentMask.doCommit(),ct(at(r.prototype),"doCommit",this).call(this)}},{key:"nearestInputPos",value:function(){for(var t,e,n=arguments.length,u=new Array(n),i=0;i<n;i++)u[i]=arguments[i];return this.currentMask?(t=this.currentMask).nearestInputPos.apply(t,u):(e=ct(at(r.prototype),"nearestInputPos",this)).call.apply(e,[this].concat(u))}},{key:"value",get:function(){return this.currentMask?this.currentMask.value:""},set:function(t){pt(at(r.prototype),"value",t,this,!0)}},{key:"unmaskedValue",get:function(){return this.currentMask?this.currentMask.unmaskedValue:""},set:function(t){pt(at(r.prototype),"unmaskedValue",t,this,!0)}},{key:"typedValue",get:function(){return this.currentMask?this.currentMask.typedValue:""},set:function(t){var e=String(t);this.currentMask&&(this.currentMask.typedValue=t,e=this.currentMask.unmaskedValue),this.unmaskedValue=e}},{key:"isComplete",get:function(){return!!this.currentMask&&this.currentMask.isComplete}},{key:"state",get:function(){return it({},ct(at(r.prototype),"state",this),{_rawInputValue:this.rawInputValue,compiledMasks:this.compiledMasks.map(function(t){return t.state}),currentMaskRef:this.currentMask,currentMask:this.currentMask&&this.currentMask.state})},set:function(t){var n=t.compiledMasks,e=t.currentMaskRef,u=t.currentMask,i=ot(t,["compiledMasks","currentMaskRef","currentMask"]);this.compiledMasks.forEach(function(t,e){return t.state=n[e]}),null!=e&&(this.currentMask=e,this.currentMask.state=u),pt(at(r.prototype),"state",i,this,!0)}}]),r}();function jt(t){var e=1<arguments.length&&void 0!==arguments[1]?arguments[1]:{};return new Mt(t,e)}return Vt.DEFAULTS={dispatch:function(i,t,r){if(t.compiledMasks.length){var a=t.rawInputValue,e=t.compiledMasks.map(function(t,e){var n=t.state;t.rawInputValue=a,t.append(i,r);var u=t.rawInputValue.length;return t.state=n,{weight:u,index:e}});return e.sort(function(t,e){return e.weight-t.weight}),t.compiledMasks[e[0].index]}}},jt.InputMask=Mt,jt.Masked=mt,jt.MaskedPattern=St,jt.MaskedEnum=Pt,jt.MaskedRange=Dt,jt.MaskedNumber=Ot,jt.MaskedDate=Tt,jt.MaskedRegExp=It,jt.MaskedFunction=Rt,jt.MaskedDynamic=Vt,jt.createMask=Ct,jt.MaskElement=wt,jt.HTMLMaskElement=xt,gt.IMask=jt});
if (typeof WannaSale == "undefined" || !WannaSale) {
    var WannaSale = {};
}

WannaSale.Lang = typeof WannaSale.Lang != 'undefined' && WannaSale.Lang ? WannaSale.Lang : {
    isUndefined : function (o) {
        return typeof o === 'undefined';
    },
    isString : function (o) {
        return typeof o === 'string';
    }
};

WannaSale.Settings = typeof WannaSale.Settings != 'undefined' && WannaSale.Settings ? WannaSale.Settings : {
    widgetKey : {},
    lang : {},
    currency : {},

    setWithData : function (
        key,
        lang,
        currency
    ) {
        this.widgetKey = key;
        this.lang = lang;
        this.currency = currency;
    }
};

WannaSale.DOM = typeof WannaSale.DOM != 'undefined' && WannaSale.DOM ? WannaSale.DOM : {

    iti : {},
    settings : {},

    get : function (el) {
        return (el && el.nodeType) ? el : document.getElementById(el);
    },

    addListener : function (el, type, fn) {
        if (WannaSale.Lang.isString(el)) { el = this.get(el); }

        if (el.addEventListener) {
            el.addEventListener(type, fn, false);
        } else if (el.attachEvent) {
            el.attachEvent('on' + type, fn);
        } else {
            el['on' + type] = fn;
        }
    },

    removeListener : function (el, type, fn) {
        if (WannaSale.Lang.isString(el)) { el = this.get(el); }

        if (el.removeEventListener){
            el.removeEventListener(type, fn, false);
        } else if (el.detachEvent) {
            el.detachEvent('on' + type, fn);
        } else {
            el['on' + type] = function () { return true; };
        }
    },

    purge : function (d) {
        var a = d.attributes, i, l, n;
        if (a) {
            l = a.length;
            for (i = 0; i < l; i += 1) {
                n = a[i].name;
                if (typeof d[n] === 'function') {
                    d[n] = null;
                }
            }
        }
        a = d.childNodes;
        if (a) {
            l = a.length;
            for (i = 0; i < l; i += 1) {
                WannaSale.DOM.purge(d.childNodes[i]);
            }
        }
    },

    setInnerHTML : function (el, html) {
        if (!el || typeof html !== 'string') {
            return null;
        }

        (function (o) {

            var a = o.attributes, i, l, n, c;
            if (a) {
                l = a.length;
                for (i = 0; i < l; i += 1) {
                    n = a[i].name;
                    if (typeof o[n] === 'function') {
                        o[n] = null;
                    }
                }
            }

            a = o.childNodes;

            if (a) {
                l = a.length;
                for (i = 0; i < l; i += 1) {
                    c = o.childNodes[i];

                    // delete child nodes
                    arguments.callee(c);
                    WannaSale.DOM.purge(c);
                }
            }

        })(el);

        el.innerHTML = html.replace(/<script[^>]*>[\S\s]*?<\/script[^>]*>/ig, "");
        return el.firstChild;
    },

    getVendorDomain : function () {
        var script = document.getElementById('wannaSaleWidget'),
            url = script.src,
            host = url.split(/\/+/)[0] + '//' + url.split(/\/+/)[1];

        return host;
    },

    getClientIP : function () {
        var ip = null;
        var xhrIP = new XMLHttpRequest();
        xhrIP.open('GET', 'https://api.ipify.org?format=jsonp&callback=', false);
        xhrIP.send();

        if (xhrIP.status == 200) {
            var data = JSON.parse(xhrIP.responseText.replace('(', '').replace(')', '').replace(';', ''));
            ip = data.ip;
            return ip;
        }
    },

    getCountryFromIP : function () {

        var ip = WannaSale.DOM.getClientIP();

        var request;
        if (window.XMLHttpRequest) { // Mozilla, Safari, ...
            request = new XMLHttpRequest();
        } else if (window.ActiveXObject) { // IE
            try {
                request = new ActiveXObject('Msxml2.XMLHTTP');
            } catch (e) {
                try {
                    request = new ActiveXObject('Microsoft.XMLHTTP');
                } catch (e) {}
            }
        }
        request.open("GET", '//ipinfo.io/' + ((ip) ? ip : ''), false);
        request.setRequestHeader("Accept", "application/json");
        request.send(null);

        if (request.status == 200) {
            var responseData = request.responseText;
            var data = JSON.parse(responseData);

            return data.country;
        }
    },

    getGeoDataFromIP : function () {
        var ip = WannaSale.DOM.getClientIP();

        var xhrIP = new XMLHttpRequest();
        xhrIP.open('GET', 'https://api.sypexgeo.net/json', false);
        xhrIP.send();

        if (xhrIP.status == 200) {
            var data = JSON.parse(xhrIP.responseText);

            return data;
        }
    },

    getWidgetButton : function (
        position,
        bottom,
        side,
        button_text,
        button_color,
        button_text_color,
        width,
        height,
        button_font_size
    ) {
        var wannaSaleButton = document.createElement('button');
        wannaSaleButton.id = 'wannaPrice';
        wannaSaleButton.innerHTML  = button_text;
        wannaSaleButton.style.backgroundColor = button_color;
        wannaSaleButton.style.color = button_text_color;
        wannaSaleButton.style.fontSize = button_font_size + 'px';
        wannaSaleButton.style.width = width + 'px';
        wannaSaleButton.style.height = height + 'px';

        if (position == '1') {
            wannaSaleButton.style.position = 'fixed';
            wannaSaleButton.style.left = side + 'px';
            wannaSaleButton.style.bottom = bottom + 'px';
        }

        if (position == '2') {
            wannaSaleButton.style.position = 'fixed';
            wannaSaleButton.style.right = side + 'px';
            wannaSaleButton.style.bottom = bottom + 'px';
        }

        if (position == '3') {
            wannaSaleButton.style.position = 'static';
        }

        return wannaSaleButton.outerHTML;
    },

    getWidgetRelatedButton : function (
        position,
        bottom,
        side,
        button_text,
        button_color,
        button_text_color,
        width,
        width_percent,
        height,
        button_font_size
    ) {
        var wannaSaleButton = document.createElement('button');
        wannaSaleButton.className = 'wannaSaleButton';
        wannaSaleButton.innerHTML  = button_text;
        wannaSaleButton.style.backgroundColor = button_color;
        wannaSaleButton.style.color = button_text_color;
        wannaSaleButton.style.position = 'relative';
        wannaSaleButton.style.height = height + 'px';
        wannaSaleButton.style.border = '0';
        wannaSaleButton.style.fontSize = button_font_size + 'px';
        wannaSaleButton.style.cursor = 'pointer';
        wannaSaleButton.style.borderRadius = '4px';

        if (width_percent == true) {
            wannaSaleButton.style.width = width + '%';
        } else {
            wannaSaleButton.style.width = width + 'px';
        }

        return wannaSaleButton.outerHTML;
    },

    setOverlay : function() {
        var wannaSaleOverlay = document.createElement('div');
        wannaSaleOverlay.className = 'wannaSaleOverlay';
        wannaSaleOverlay.style.backgroundColor = 'rgba(0, 0, 0, 0.8)';
        wannaSaleOverlay.style.position = 'fixed';
        wannaSaleOverlay.style.width = '100%';
        wannaSaleOverlay.style.height = '100%';
        wannaSaleOverlay.style.left = '0px';
        wannaSaleOverlay.style.top = '0px';
        wannaSaleOverlay.style.zIndex = '999997';
        document.body.appendChild(wannaSaleOverlay);
    },

    removeOverlay : function() {
        var elements = document.getElementsByClassName('wannaSaleOverlay');
        for (var i = 0; i < elements.length; ++i) {
            var item = elements[i];
            item.remove();
        }
    },

    setFinalMessage : function (
        message_text,
        message_text_color,
        message_background_color
    ) {
        var message = document.createElement('p');
        message.className = 'wannaSaleMessage';
        message.style.padding = '30px 40px 30px 40px';
        message.style.textAlign = 'center';
        message.style.fontSize = '13px';
        message.style.position = 'fixed';
        message.style.top = '50%';
        message.style.left = '50%';
        message.style.transform = 'translate(-50%, -50%)';
        message.style.backgroundColor = message_background_color;
        message.style.color = message_text_color;
        message.style.zIndex = '999998';
        message.innerHTML = message_text;

        document.body.appendChild(message);

        return message.outerHTML;
    },

    refreshFormFields : function () {
        if (document.getElementById("wannaSaleItemId") !== null) {
            document.getElementById("wannaSaleItemId").value = '';
        }
        if (document.getElementById("wannaSaleItemName") !== null) {
            document.getElementById("wannaSaleItemName").value = '';
        }
        // document.getElementById("wannaSaleSessionKey").value = '';
        document.getElementById("wannaSaleName").value = '';
        document.getElementById("wannaSaleEmail").value = '';
        if (document.getElementById("wannaSalePhone") !== null) {
            document.getElementById("wannaSalePhone").value = '';
            // document.getElementById("wannaSaleCountryCode").value = '';
        }
        // document.getElementById("wannaSaleIpCity").value = '';
        // document.getElementById("wannaSaleIpCountry").value = '';
        document.getElementById("wannaSalePrice").value = '';
    },

    removeMessage : function() {
        var elements = document.getElementsByClassName('wannaSaleMessage');
        for (var i = 0; i < elements.length; ++i) {
            var item = elements[i];
            item.remove();
        }
    },

    setWindowSettings : function (
        position,
        side,
        bottom,
        title_text,
        title_color,
        text,
        checkbox_text,
        window_button_text,
        window_button_color,
        window_button_text_color
    ) {

        var wannaSaleForm = document.getElementById('wannaSaleForm');
        if (position == 1) {
            wannaSaleForm.style.position = 'fixed';
            wannaSaleForm.style.left = side + 'px';
            wannaSaleForm.style.bottom = bottom + 'px';
        }

        if (position == 2) {
            wannaSaleForm.style.position = 'fixed';
            wannaSaleForm.style.right = side + 'px';
            wannaSaleForm.style.bottom = bottom + 'px';
        }

        if (position == 3) {
            wannaSaleForm.style.position = 'fixed';
            wannaSaleForm.style.top = '50%';
            wannaSaleForm.style.left = '50%';
            wannaSaleForm.style.transform = 'translate(-50%, -50%)';
        }

        var wannaSaleTitle = document.getElementById('wannaSaleTitle');
        var wannaSaleText = document.getElementById('wannaSaleText');
        wannaSaleText.innerText = text;

        var wannaCheckLabel = document.getElementById('wannaCheckLabel');
        wannaCheckLabel.innerText = checkbox_text;

        var wannaSaleSubmit = document.getElementById('wannaSaleSubmit');
        wannaSaleSubmit.innerText = window_button_text;
        wannaSaleSubmit.style.backgroundColor = window_button_color;
        wannaSaleSubmit.style.color = window_button_text_color;
    },

    validateForm : function () {

        var result = document.getElementById('widgetTextStatus');
        result.innerText = '';
        var inputItemName = document.getElementById('wannaSaleItemName');
        if (inputItemName !== null) {

            if (inputItemName.value == '') {
                inputItemName.style.borderBottom = '1px solid #ff4d00';
                result.innerHTML = 'Введите информацию о товаре.';

                return false;
            } else {
                inputItemName.style.borderBottom = '0px solid #ff4d00';
            }
        }

        var inputName = document.getElementById('wannaSaleName');
        if (inputName !== null) {
            var pattern = new RegExp(/^[а-яА-яAa-zA-z\-\ ]/i);
            if (!pattern.test(inputName.value)) {
                inputName.style.borderBottom = '1px solid red';
                result.innerHTML = 'Введите своё имя корректно.';

                return false;
            } else {
                inputName.style.borderBottom = '0px solid red';
            }
        }

        var inputEmail = document.getElementById('wannaSaleEmail');
        if (inputEmail !== null) {
            var pattern = new RegExp(/^[^\s@]+@[^\s@]+\.[^\s@]+$/);
            if (!pattern.test(inputEmail.value)) {
                inputEmail.style.borderBottom = '1px solid red';
                result.innerHTML = 'Введите свой адрес электронной почты корректно.';

                return false;
            } else {
                inputEmail.style.borderBottom = '0px solid red';
            }
        }

        if (document.getElementById('wannaSalePhone') !== null) {
            var inputPhone = document.getElementById('wannaSalePhone');
            if (inputPhone !== null) {

                if (inputPhone.value == '') {
                    inputPhone.style.borderBottom = '1px solid red';
                    result.innerHTML = 'Введите номер телефона.';

                    return false;
                } else {
                    inputPhone.style.borderBottom = '0px solid red';
                }
            }
        }

        var inputPrice = document.getElementById('wannaSalePrice');
        if (inputPrice !== null) {
            var pattern = new RegExp(/^[0-9]/i);
            if (!pattern.test(inputPrice.value)) {
                inputPrice.style.borderBottom = '1px solid red';
                result.innerHTML = 'Введите цену корректно.';

                return false;
            } else {
                inputPrice.style.borderBottom = '0px solid red';
            }
        };

        var inputCheck = document.getElementById('wannaCheck');
        if (inputCheck !== null) {
            if (inputCheck.checked === false) {
                result.innerHTML = 'Вы не подтвердили согласие на обработку данных.';

                return false;
            }
        }

        var customFields = document.getElementsByClassName('wannaSaleCustomField');

        for (var i = 0; i < customFields.length; ++i) {

            var fieldValue = customFields[i].value;
            var fieldType = customFields[i].dataset.type;
            var fieldTitle = customFields[i].dataset.title;

            if (fieldType == 'word') {
                var pattern = new RegExp(/^[а-яА-яAa-zA-z\-\ ]/i);
                if (!pattern.test(fieldValue)) {
                    result.innerHTML = 'Значение поля ' + customFields[i].dataset.title.toLowerCase() + ' должно быть строкой.';
                    return false;
                }
            } else if (fieldType == 'integer') {
                var pattern = new RegExp(/^[0-9]/i);
                if (!pattern.test(fieldValue)) {
                    result.innerHTML = 'Значение поля ' + customFields[i].dataset.title.toLowerCase() + ' должно быть числом.';
                    return false;
                }
            } else if (fieldType == 'text') {
                if (fieldType == '') {
                    result.innerHTML = 'Значение поля ' + customFields[i].dataset.title.toLowerCase() + ' должно быть текстом.';
                    return false;
                }
            }
        }

        return true;
    }
};

WannaSale.Ajax = typeof WannaSale.Ajax != 'undefined' && WannaSale.Ajax ? WannaSale.Ajax : {

    initWidget : function (o) {

        var xhrRequest = new XMLHttpRequest();
        xhrRequest.open('POST', WannaSale.DOM.getVendorDomain() + '/api/v1/displayWidget', false);

        xhrRequest.setRequestHeader('Authorization', o.key);
        xhrRequest.setRequestHeader('Accept-Language', o.lang);
        xhrRequest.setRequestHeader('Currency', o.currency);
        xhrRequest.setRequestHeader('Url', window.location);
        xhrRequest.send();

        if (xhrRequest.status == 200) {
            if (xhrRequest.readyState == 4 && xhrRequest.status == 200) {
                if (xhrRequest.responseText) {

                    var responseData = JSON.parse(xhrRequest.response);
                    if (responseData.data.load === true) {

                        var displaySettings = responseData.data.display_settings;
                        var customFields = responseData.data.custom_fields;

                        WannaSale.Button.render(displaySettings, o.key, responseData.data.session_key);
                        WannaSale.Window.render(
                            displaySettings,
                            responseData.data.content,
                            o.key,
                            o.lang,
                            o.currency,
                            responseData.data.session_key
                        );
                    }
                }
            }
        } else {
            return null;
        }
    },

    sendOpenRequest : function (widgetKey, sessionKey) {

        var ip = WannaSale.DOM.getClientIP();
        var widgetId = widgetKey;
        var xhrRequest = new XMLHttpRequest();
        var formData = new FormData();

        formData.append('session_key', sessionKey);

        xhrRequest.open('POST', WannaSale.DOM.getVendorDomain() + '/api/v1/setWidgetOpen', true);

        xhrRequest.setRequestHeader('Authorization', widgetId);
        xhrRequest.setRequestHeader('IP', ip);
        xhrRequest.setRequestHeader('Url', window.location);
        // xhrRequest.setRequestHeader('Accept-Language', lang);
        xhrRequest.setRequestHeader('X-User-Agent', navigator.userAgent);
        xhrRequest.send(formData);
    },

    sendRequest : function (widgetKey, lang, currency) {

        var ip = WannaSale.DOM.getClientIP();
        var widgetId = widgetKey;
        var xhrRequest = new XMLHttpRequest();
        var formData = new FormData();

        if (document.getElementById("wannaSaleItemId") !== null) {
            formData.append('item_id', document.getElementById("wannaSaleItemId").value)
        }

        if (document.getElementById("wannaSaleItemName") !== null) {
            formData.append('item_name', document.getElementById("wannaSaleItemName").value);
        }

        formData.append('session_key', document.getElementById("wannaSaleSessionKey").value);
        formData.append('name', document.getElementById("wannaSaleName").value);
        formData.append('email', document.getElementById("wannaSaleEmail").value);
        if (document.getElementById('wannaSalePhone') !== null) {
            formData.append('phone', document.getElementById("wannaSalePhone").value);
            formData.append('country', document.getElementById("wannaSaleCountryCode").value);
        }
        formData.append('offered_price', document.getElementById("wannaSalePrice").value);
        formData.append('currency', currency);

        formData.append('ip_city', document.getElementById("wannaSaleIpCity").value);
        formData.append('ip_country', document.getElementById("wannaSaleIpCountry").value);

        // Custom fields

        var customFields = document.getElementsByClassName('wannaSaleCustomField');
        for (var i = 0; i < customFields.length; ++i) {
            var fieldName = customFields[i].name;
            var fieldTitle = customFields[i].dataset.title;
            var fieldValue = customFields[i].value;

            formData.append('custom_fields[' + i + '][name]', fieldName);
            formData.append('custom_fields[' + i + '][title]', fieldTitle);
            formData.append('custom_fields[' + i + '][value]', fieldValue);
        }

        xhrRequest.open('POST', WannaSale.DOM.getVendorDomain() + '/api/v1/setWidgetRequest', false);

        xhrRequest.setRequestHeader('Authorization', widgetId);
        xhrRequest.setRequestHeader('IP', ip);
        xhrRequest.setRequestHeader('Url', window.location);
        xhrRequest.setRequestHeader('Accept-Language', lang);
        xhrRequest.setRequestHeader('X-User-Agent', navigator.userAgent);
        xhrRequest.send(formData);

        if (xhrRequest.status == 200) {
            if (xhrRequest.readyState == 4 && xhrRequest.status == 200) {
                if (xhrRequest.responseText) {

                    var messageText = document.getElementById('wannaSaleSettings').dataset.messageText;
                    var messageTextColor = document.getElementById('wannaSaleSettings').dataset.messageTextColor;
                    var messageBackgroundColor = document.getElementById('wannaSaleSettings').dataset.messageBackgroundColor;

                    var message = WannaSale.DOM.setFinalMessage(
                        messageText,
                        messageTextColor,
                        messageBackgroundColor
                    );

                    var responseData = JSON.parse(xhrRequest.response);
                    var form = document.getElementById('wannaSaleForm');
                    form.style.display = 'none';

                    setTimeout(function () {
                        WannaSale.DOM.removeMessage();
                        WannaSale.DOM.removeOverlay();
                        WannaSale.DOM.refreshFormFields();
                    }, 5000);

                    WannaSale.Dialog.show(
                        WannaSale.Settings.widgetKey,
                        WannaSale.Settings.lang,
                        WannaSale.Settings.currency
                    );
                }
            }
        } else if(xhrRequest.status == 422) {

            if (document.getElementById("wannaSalePhone") !== null) {
                var result = document.getElementById('widgetTextStatus');
                result.innerText = '';

                var inputPrice = document.getElementById('wannaSalePhone');
                inputPrice.style.border = '1px solid red';
                result.innerHTML = 'Неверный формат номера телефона.';
            }
        }
    }
};

WannaSale.Button = typeof WannaSale.Button != 'undefined' && WannaSale.Button ? WannaSale.Button : {

    render : function (displaySettings, widgetKey, sessionKey) {

        var buttonContainer = document.createElement('div');
        document.body.appendChild(buttonContainer);

        if (displaySettings.position == '3') {

            var html = WannaSale.DOM.getWidgetRelatedButton(
                displaySettings.position,
                displaySettings.bottom,
                displaySettings.side,
                displaySettings.button_text,
                displaySettings.button_color,
                displaySettings.button_text_color,
                displaySettings.button_width,
                displaySettings.button_width_percent,
                displaySettings.button_height,
                displaySettings.button_font_size
            );

            var elements = document.getElementsByClassName('wannaSaleButton');
            for (var i = 0; i < elements.length; ++i) {
                var item = elements[i];
                item.outerHTML = html;
            }

            var classname = document.getElementsByClassName("wannaSaleButton");

            var myFunction = function() {
                WannaSale.DOM.setOverlay();
                WannaSale.Button.click(displaySettings);
                WannaSale.Ajax.sendOpenRequest(widgetKey, sessionKey);
            };

            for (var i = 0; i < classname.length; i++) {
                classname[i].addEventListener('click', myFunction, false);
            }

        } else {

            var html = WannaSale.DOM.getWidgetButton(
                displaySettings.position,
                displaySettings.bottom,
                displaySettings.side,
                displaySettings.button_text,
                displaySettings.button_color,
                displaySettings.button_text_color,
                displaySettings.button_width,
                displaySettings.button_height,
                displaySettings.button_font_size
            );

            WannaSale.DOM.setInnerHTML(buttonContainer, html);

            WannaSale.DOM.addListener('wannaPrice', 'click', function (e) {
                WannaSale.Button.click(displaySettings);
                WannaSale.Ajax.sendOpenRequest(widgetKey, sessionKey);
                WannaSale.DOM.setOverlay();

                return false;
            });
        }
    },

    click : function (displaySettings) {
        var wannaSaleForm = document.getElementById('wannaSaleForm');
        wannaSaleForm.style.display = 'block';

        if (displaySettings.position != '3') {
            var wannaPrice = document.getElementById('wannaPrice');
            wannaPrice.style.display = 'none';
        }

        return false;
    }

};

WannaSale.Window = typeof WannaSale.Window != 'undefined' && WannaSale.Window ? WannaSale.Window : {

    render : function (
        displaySettings,
        contentHTML,
        widgetKey,
        lang,
        currency,
        session_key
    ) {

        var wannaSaleWindow = document.createElement('div');
        wannaSaleWindow.innerHTML = contentHTML;
        document.body.appendChild(wannaSaleWindow);

        WannaSale.DOM.setWindowSettings(
            displaySettings.position,
            displaySettings.side,
            displaySettings.bottom,
            displaySettings.title_text,
            displaySettings.title_color,
            displaySettings.text,
            displaySettings.checkbox_text,
            displaySettings.window_button_text,
            displaySettings.window_button_color,
            displaySettings.window_button_text_color,
            displaySettings.show_phone
        );

        if (document.getElementById('wannaSalePhone') !== null) {
            /* this.initCountryCode();

            function insertCookies(event) {

                if (event.data.name !== '' && event.data.name !== undefined) {
                    document.getElementById('wannaSaleName').value = event.data.name;
                }
                if (event.data.phone !== '' && event.data.phone !== undefined) {
                    document.getElementById('wannaSalePhone').value = event.data.phone;
                }
                if (event.data.email !== '' && event.data.email !== undefined) {
                    document.getElementById('wannaSaleEmail').value = event.data.email;
                }
                if (event.data.country !== '' && event.data.country !== undefined) {
                    document.getElementById('wannaSaleCountryCode').value = event.data.country;
                    var iti = WannaSale.DOM.iti;
                    iti.setFlag(event.data.country);

                    var mask = inputPhone.getAttribute('placeholder').replace(/[1-9]/g, "0");
                    var phoneMask = new IMask(
                        document.getElementById('wannaSalePhone'), {
                            mask: mask
                        });
                }
            }

            if (window.addEventListener) {
                window.addEventListener("message", insertCookies);
            } else {
                // IE8
                window.attachEvent("onmessage", insertCookies);
            } */
        }

        WannaSale.DOM.addListener('wannaSaleClose', 'click', function (e) {
            var wannaSaleForm = document.getElementById('wannaSaleForm');
            wannaSaleForm.style.display = 'none';

            var wannaPrice = document.getElementById('wannaPrice');
            if (wannaPrice !== null) {
                wannaPrice.style.display = 'block';
            }

            WannaSale.DOM.removeOverlay();

            return false;
        });

        WannaSale.DOM.addListener('wannaSaleSubmit', 'click', function (e) {
            WannaSale.Window.submit(widgetKey, lang, currency);
        });

        WannaSale.DOM.addListener('selectedCountry', 'click', function (e) {
            var selectCountry = document.getElementById('selectCountry');
            selectCountry.style.display = 'block';
        });

        var phoneMask = new IMask(
            document.getElementById('wannaSalePhone'), {
                mask: '0 000 000 00 00'
            });

        var wannaSalePhone = document.getElementById('wannaSalePhone');
        wannaSalePhone.setAttribute('placeholder', '0 000 000 00 00');

        var hiddenSessionKey = document.getElementById('wannaSaleSessionKey');
        hiddenSessionKey.value = session_key;

        var geoData = WannaSale.DOM.getGeoDataFromIP();
        var city = geoData['city']['name_ru'];
        var country = geoData['country']['name_ru'];
        var countryCode = geoData['country']['iso'];

        var hiddenCountryCode = document.getElementById('wannaSaleCountryCode');
        hiddenCountryCode.value = countryCode;

        var wannaSaleIpCountry = document.getElementById('wannaSaleIpCountry');
        wannaSaleIpCountry.value = country;

        var wannaSaleIpCity = document.getElementById('wannaSaleIpCity');
        wannaSaleIpCity.value = city;

        var ul = document.getElementById('selectCountry');  // Parent
        ul.addEventListener('click', function(e) {

            if (e.target.tagName === 'LI'){
                var iso = e.target.getAttribute('data-iso');
                var mask = e.target.getAttribute('data-mask');

                var wannaSalePhone = document.getElementById('wannaSalePhone');
                wannaSalePhone.value = '';
                wannaSalePhone.setAttribute('placeholder', mask);

                var hiddenCountryCode = document.getElementById('wannaSaleCountryCode');
                hiddenCountryCode.value = iso;

                phoneMask.updateOptions({mask: mask});

                var img = e.target.querySelector('img');
                var selectedCountryImg = document.getElementById('selectedCountryImg');
                selectedCountryImg.setAttribute('src', img.getAttribute('src'));
            } else {
                var iso = e.target.parentNode.getAttribute('data-iso');
                var mask = e.target.parentNode.getAttribute('data-mask');

                var wannaSalePhone = document.getElementById('wannaSalePhone');
                wannaSalePhone.value = '';
                wannaSalePhone.setAttribute('placeholder', mask);

                var hiddenCountryCode = document.getElementById('wannaSaleCountryCode');
                hiddenCountryCode.value = iso;

                phoneMask.updateOptions({mask: mask});

                if (e.target.tagName === 'IMG'){
                    var img = e.target;
                    var selectedCountryImg = document.getElementById('selectedCountryImg');
                    selectedCountryImg.setAttribute('src', img.getAttribute('src'));
                } else if (e.target.tagName === 'SPAN') {

                }
            }

            ul.style.display = 'none';
        });
    },

    cookiesCatch : function() {

    },

    initCountryCode : function () {
        // var countryCode = WannaSale.DOM.getCountryFromIP();
        var geoData = WannaSale.DOM.getGeoDataFromIP();
        var city = geoData['city']['name_ru'];
        var country = geoData['country']['name_ru'];
        var countryCode = geoData['country']['iso'];

        var inputPhone = document.getElementById('wannaSalePhone');
        var hiddenCountryCode = document.getElementById('wannaSaleCountryCode');
        document.getElementById('wannaSaleIpCity').value = city;
        document.getElementById('wannaSaleIpCountry').value = country;

        hiddenCountryCode.value = countryCode;
        var iti = intlTelInput(inputPhone, {
            initialCountry: countryCode.toLowerCase(),
        });

        WannaSale.DOM.iti = iti;

        var mask = inputPhone.getAttribute('placeholder').replace(/[1-9]/g, "0");
        var phoneMask = new IMask(
            document.getElementById('wannaSalePhone'), {
                mask: mask
        });

        var dropdowns = document.getElementsByClassName('country');
        for (i = 0; i < dropdowns.length - 1; i++) {

            dropdowns[i].addEventListener("click", function () {
                hiddenCountryCode = document.getElementById('wannaSaleCountryCode');
                hiddenCountryCode.value = this.getAttribute('data-country-code');

                setTimeout(function () {
                    inputPhone.value = '';
                    var mask = inputPhone.getAttribute('placeholder').replace(/[1-9]/g, "0");
                    var phoneMask = new IMask(
                        document.getElementById('wannaSalePhone'), {
                            mask: mask
                    });
                }, 100);
            });
        }
    },

    submit : function (widgetKey, lang, currency) {

        var validateResult = WannaSale.DOM.validateForm();

        if (validateResult) {
            WannaSale.Ajax.sendRequest(
                widgetKey,
                lang,
                currency
            );
        }

    }
};

// YAHOO module pattern: http://ajaxian.com/archives/a-javascript-module-pattern
WannaSale.Dialog = typeof WannaSale.Dialog != 'undefined' && WannaSale.Dialog ? WannaSale.Dialog : function () {

    return {

        show : function (o) {

            if (o.key !== undefined && WannaSale.DOM.getVendorDomain() !== undefined) {

                var settings = WannaSale.Settings.setWithData(
                    o.key,
                    o.lang,
                    o.currency
                );

                WannaSale.DOM.settings = settings;
                WannaSale.Ajax.initWidget(o);
            }
        }

    };

}();
//# sourceMappingURL=init.js.map
