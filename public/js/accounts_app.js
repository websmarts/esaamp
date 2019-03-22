!function(t){var e={};function n(s){if(e[s])return e[s].exports;var o=e[s]={i:s,l:!1,exports:{}};return t[s].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=t,n.c=e,n.d=function(t,e,s){n.o(t,e)||Object.defineProperty(t,e,{configurable:!1,enumerable:!0,get:s})},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="",n(n.s=2)}({2:function(t,e,n){t.exports=n("ZEVL")},"20cu":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={data:function(){return{tokens:[]}},ready:function(){this.prepareComponent()},mounted:function(){this.prepareComponent()},methods:{prepareComponent:function(){this.getTokens()},getTokens:function(){var t=this;axios.get("/oauth/tokens").then(function(e){t.tokens=e.data})},revoke:function(t){var e=this;axios.delete("/oauth/tokens/"+t.id).then(function(t){e.getTokens()})}}}},"5m3O":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var s="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t};e.default={data:function(){return{clients:[],createForm:{errors:[],name:"",redirect:""},editForm:{errors:[],name:"",redirect:""}}},ready:function(){this.prepareComponent()},mounted:function(){this.prepareComponent()},methods:{prepareComponent:function(){this.getClients()},getClients:function(){var t=this;axios.get("/oauth/clients").then(function(e){t.clients=e.data})},showCreateClientForm:function(){},store:function(){this.persistClient("post","/oauth/clients",this.createForm,"#modal-create-client")},edit:function(t){this.editForm.id=t.id,this.editForm.name=t.name,this.editForm.redirect=t.redirect},update:function(){this.persistClient("put","/oauth/clients/"+this.editForm.id,this.editForm,"#modal-edit-client")},persistClient:function(t,e,n,o){var a=this;n.errors=[],axios[t](e,n).then(function(t){a.getClients(),n.name="",n.redirect="",n.errors=[],$(o).modal("hide")}).catch(function(t){"object"===s(t.response.data)?n.errors=_.flatten(_.toArray(t.response.data)):n.errors=["Something went wrong. Please try again."]})},destroy:function(t){var e=this;axios.delete("/oauth/clients/"+t.id).then(function(t){e.getClients()})}}}},"A/e+":function(t,e,n){var s=n("VU/8")(n("5m3O"),n("qh0x"),!1,function(t){n("nQ7D")},"data-v-a9e45962",null);t.exports=s.exports},"FZ+f":function(t,e){t.exports=function(t){var e=[];return e.toString=function(){return this.map(function(e){var n=function(t,e){var n=t[1]||"",s=t[3];if(!s)return n;if(e&&"function"==typeof btoa){var o=(i=s,"/*# sourceMappingURL=data:application/json;charset=utf-8;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(i))))+" */"),a=s.sources.map(function(t){return"/*# sourceURL="+s.sourceRoot+t+" */"});return[n].concat(a).concat([o]).join("\n")}var i;return[n].join("\n")}(e,t);return e[2]?"@media "+e[2]+"{"+n+"}":n}).join("")},e.i=function(t,n){"string"==typeof t&&(t=[[null,t,""]]);for(var s={},o=0;o<this.length;o++){var a=this[o][0];"number"==typeof a&&(s[a]=!0)}for(o=0;o<t.length;o++){var i=t[o];"number"==typeof i[0]&&s[i[0]]||(n&&!i[2]?i[2]=n:n&&(i[2]="("+i[2]+") and ("+n+")"),e.push(i))}},e}},KU4Q:function(t,e,n){(t.exports=n("FZ+f")(!1)).push([t.i,".action-link[data-v-a9e45962]{cursor:pointer}.m-b-none[data-v-a9e45962]{margin-bottom:0}",""])},LiAU:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("div",[n("div",{staticClass:"panel panel-default"},[n("div",{staticClass:"panel-heading"},[n("div",{staticStyle:{display:"flex","justify-content":"space-between","align-items":"center"}},[n("span",[t._v("\n                        Personal Access Tokens\n                    ")]),t._v(" "),n("a",{staticClass:"action-link",on:{click:function(e){return t.createTokenModal("show")}}},[t._v("\n                        Create New Token\n                    ")])])]),t._v(" "),n("div",{staticClass:"panel-block"},[0===t.tokens.length?n("p",{staticClass:"m-b-none"},[t._v("\n                    You have not created any personal access tokens.\n                ")]):t._e(),t._v(" "),t.tokens.length>0?n("table",{staticClass:"table table-borderless m-b-none"},[t._m(0),t._v(" "),n("tbody",t._l(t.tokens,function(e){return n("tr",[n("td",{staticStyle:{"vertical-align":"middle"}},[t._v("\n                                "+t._s(e.name)+"\n                            ")]),t._v(" "),n("td",{staticStyle:{"vertical-align":"middle"}},[n("a",{staticClass:"action-link text-danger",on:{click:function(n){return t.revoke(e)}}},[t._v("\n                                    Delete\n                                ")])])])}),0)]):t._e()])])]),t._v(" "),n("div",{staticClass:"modal",class:t.showCreateTokenModal,attrs:{id:"modal-create-token",tabindex:"-1",role:"dialog"}},[n("div",{staticClass:"modal-background"}),t._v(" "),n("div",{staticClass:"modal-card"},[n("div",{staticClass:"box"},[n("div",{staticClass:"modal-card-head"},[n("h4",{staticClass:"modal-card-title"},[t._v("\n                        Create Token\n                    ")]),t._v(" "),n("button",{staticClass:"delete",attrs:{"aria-label":"close"},on:{click:function(e){return t.createTokenModal("hide")}}})]),t._v(" "),n("div",{staticClass:"modal-card-body"},[t.form.errors.length>0?n("div",{staticClass:"alert alert-danger"},[t._m(1),t._v(" "),n("br"),t._v(" "),n("ul",t._l(t.form.errors,function(e){return n("li",[t._v("\n                                "+t._s(e)+"\n                            ")])}),0)]):t._e(),t._v(" "),n("form",{attrs:{role:"form"},on:{submit:function(e){return e.preventDefault(),t.store(e)}}},[n("div",{staticClass:"field"},[n("label",{staticClass:"label"},[t._v("Name")]),t._v(" "),n("div",{staticClass:"control"},[n("input",{directives:[{name:"model",rawName:"v-model",value:t.form.name,expression:"form.name"}],ref:"create_token_name",staticClass:"input",attrs:{id:"create-token-name",type:"text",name:"name"},domProps:{value:t.form.name},on:{input:function(e){e.target.composing||t.$set(t.form,"name",e.target.value)}}})])]),t._v(" "),t.scopes.length>0?n("div",{staticClass:"field"},[n("label",{staticClass:"label"},[t._v("Scopes")]),t._v(" "),n("div",{staticClass:"control"},t._l(t.scopes,function(e){return n("div",[n("label",{staticClass:"checkbox"},[n("input",{attrs:{type:"checkbox"},domProps:{checked:t.scopeIsAssigned(e.id)},on:{click:function(n){return t.toggleScope(e.id)}}}),t._v("\n\n                                                "+t._s(e.id)+"\n                                        ")])])}),0)]):t._e()])]),t._v(" "),n("div",{staticClass:"modal-card-foot"},[n("button",{staticClass:"modal-close is-large",attrs:{"aria-label":"close","aria-hidden":"true"},on:{click:function(e){return t.createTokenModal("hide")}}}),t._v(" "),n("button",{staticClass:"button",attrs:{type:"button"},on:{click:t.store}},[t._v("\n                        Create\n                    ")])])])])]),t._v(" "),n("div",{staticClass:"modal",class:t.showTokenAccessModal,attrs:{id:"modal-access-token",tabindex:"-1",role:"dialog"}},[n("div",{staticClass:"modal-background"}),t._v(" "),n("div",{staticClass:"modal-card"},[n("div",{staticClass:"modal-card-head"},[n("h4",{staticClass:"modal-card-title"},[t._v("\n                        Personal Access Token\n                    ")]),t._v(" "),n("button",{staticClass:"delete",attrs:{"aria-label":"close"},on:{click:function(e){return t.newTokenModal("hide")}}})]),t._v(" "),n("div",{staticClass:"modal-card-body"},[n("p",[t._v("\n                        Here is your new personal access token. This is the only time it will be shown so don't lose it!\n                        You may now use this token to make API requests.\n                    ")]),t._v(" "),n("pre",[n("code",[t._v(t._s(t.accessToken))])])]),t._v(" "),n("div",{staticClass:"modal-card-foot"},[n("button",{staticClass:"button",attrs:{type:"button"},on:{click:function(e){return t.newTokenModal("hide")}}},[t._v("Close")])])])])])},staticRenderFns:[function(){var t=this.$createElement,e=this._self._c||t;return e("thead",[e("tr",[e("th",[this._v("Name")]),this._v(" "),e("th")])])},function(){var t=this.$createElement,e=this._self._c||t;return e("p",[e("strong",[this._v("Whoops!")]),this._v(" Something went wrong!")])}]}},Lypw:function(t,e,n){var s=n("VU/8")(n("lAxH"),n("LiAU"),!1,function(t){n("MK28")},"data-v-cd52adf0",null);t.exports=s.exports},MK28:function(t,e,n){var s=n("axm7");"string"==typeof s&&(s=[[t.i,s,""]]),s.locals&&(t.exports=s.locals);n("rjj0")("658fd396",s,!0,{})},"Q+oC":function(t,e,n){var s=n("joR7");"string"==typeof s&&(s=[[t.i,s,""]]),s.locals&&(t.exports=s.locals);n("rjj0")("30bbed0c",s,!0,{})},"VU/8":function(t,e){t.exports=function(t,e,n,s,o,a){var i,r=t=t||{},c=typeof t.default;"object"!==c&&"function"!==c||(i=t,r=t.default);var l,d="function"==typeof r?r.options:r;if(e&&(d.render=e.render,d.staticRenderFns=e.staticRenderFns,d._compiled=!0),n&&(d.functional=!0),o&&(d._scopeId=o),a?(l=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),s&&s.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(a)},d._ssrRegister=l):s&&(l=s),l){var u=d.functional,v=u?d.render:d.beforeCreate;u?(d._injectStyles=l,d.render=function(t,e){return l.call(e),v(t,e)}):d.beforeCreate=v?[].concat(v,l):[l]}return{esModule:i,exports:r,options:d}}},ZEVL:function(t,e,n){Vue.component("passport-clients",n("A/e+")),Vue.component("passport-authorized-clients",n("ooDj")),Vue.component("passport-personal-access-tokens",n("Lypw"));new Vue({el:"#app"})},axm7:function(t,e,n){(t.exports=n("FZ+f")(!1)).push([t.i,".action-link[data-v-cd52adf0]{cursor:pointer}.m-b-none[data-v-cd52adf0]{margin-bottom:0}",""])},joR7:function(t,e,n){(t.exports=n("FZ+f")(!1)).push([t.i,".action-link[data-v-7b02ac45]{cursor:pointer}.m-b-none[data-v-7b02ac45]{margin-bottom:0}",""])},lAxH:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var s="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t};e.default={data:function(){return{accessToken:null,showCreateTokenModal:{"is-active":!1},showTokenAccessModal:{"is-active":!1},tokens:[],scopes:[],form:{name:"",scopes:[],errors:[]}}},ready:function(){this.prepareComponent()},mounted:function(){this.prepareComponent()},methods:{prepareComponent:function(){this.getTokens(),this.getScopes()},getTokens:function(){var t=this;axios.get("/oauth/personal-access-tokens").then(function(e){t.tokens=e.data})},getScopes:function(){var t=this;axios.get("/oauth/scopes").then(function(e){t.scopes=e.data})},createTokenModal:function(){var t=this;if("show"==(arguments.length>0&&void 0!==arguments[0]?arguments[0]:"hide"))return this.showCreateTokenModal["is-active"]=!0,void this.$nextTick(function(){return t.$refs.create_token_name.focus()});this.showCreateTokenModal["is-active"]=!1},newTokenModal:function(){"show"!=(arguments.length>0&&void 0!==arguments[0]?arguments[0]:"hide")?this.showTokenAccessModal["is-active"]=!1:this.showTokenAccessModal["is-active"]=!0},store:function(){var t=this;this.accessToken=null,this.form.errors=[],axios.post("/oauth/personal-access-tokens",this.form).then(function(e){t.form.name="",t.form.scopes=[],t.form.errors=[],t.tokens.push(e.data.token),t.showAccessToken(e.data.accessToken)}).catch(function(e){"object"===s(e.response.data)?t.form.errors=_.flatten(_.toArray(e.response.data)):t.form.errors=["Something went wrong. Please try again."]})},toggleScope:function(t){this.scopeIsAssigned(t)?this.form.scopes=_.reject(this.form.scopes,function(e){return e==t}):this.form.scopes.push(t)},scopeIsAssigned:function(t){return _.indexOf(this.form.scopes,t)>=0},showAccessToken:function(t){this.createTokenModal("hide"),this.accessToken=t,this.newTokenModal("show")},revoke:function(t){var e=this;axios.delete("/oauth/personal-access-tokens/"+t.id).then(function(t){e.getTokens()})}}}},nQ7D:function(t,e,n){var s=n("KU4Q");"string"==typeof s&&(s=[[t.i,s,""]]),s.locals&&(t.exports=s.locals);n("rjj0")("414da36a",s,!0,{})},ooDj:function(t,e,n){var s=n("VU/8")(n("20cu"),n("v2Db"),!1,function(t){n("Q+oC")},"data-v-7b02ac45",null);t.exports=s.exports},qh0x:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("div",{staticClass:"panel panel-default"},[n("div",{staticClass:"panel-heading"},[n("div",{staticStyle:{display:"flex","justify-content":"space-between","align-items":"center"}},[n("span",[t._v("\n                    OAuth Clients\n                ")]),t._v(" "),n("a",{staticClass:"action-link",on:{click:t.showCreateClientForm}},[t._v("\n                    Create New Client\n                ")])])]),t._v(" "),n("div",{staticClass:"panel-block"},[0===t.clients.length?n("p",{staticClass:"m-b-none"},[t._v("\n                You have not created any OAuth clients.\n            ")]):t._e(),t._v(" "),t.clients.length>0?n("table",{staticClass:"table table-borderless m-b-none"},[t._m(0),t._v(" "),n("tbody",t._l(t.clients,function(e){return n("tr",[n("td",{staticStyle:{"vertical-align":"middle"}},[t._v("\n                            "+t._s(e.id)+"\n                        ")]),t._v(" "),n("td",{staticStyle:{"vertical-align":"middle"}},[t._v("\n                            "+t._s(e.name)+"\n                        ")]),t._v(" "),n("td",{staticStyle:{"vertical-align":"middle"}},[n("code",[t._v(t._s(e.secret))])]),t._v(" "),n("td",{staticStyle:{"vertical-align":"middle"}},[n("a",{staticClass:"action-link",on:{click:function(n){return t.edit(e)}}},[t._v("\n                                Edit\n                            ")])]),t._v(" "),n("td",{staticStyle:{"vertical-align":"middle"}},[n("a",{staticClass:"action-link text-danger",on:{click:function(n){return t.destroy(e)}}},[t._v("\n                                Delete\n                            ")])])])}),0)]):t._e()])]),t._v(" "),n("div",{staticClass:"modal fade",attrs:{id:"modal-create-client",tabindex:"-1",role:"dialog"}},[n("div",{staticClass:"modal-dialog"},[n("div",{staticClass:"modal-content"},[t._m(1),t._v(" "),n("div",{staticClass:"modal-body"},[t.createForm.errors.length>0?n("div",{staticClass:"alert alert-danger"},[t._m(2),t._v(" "),n("br"),t._v(" "),n("ul",t._l(t.createForm.errors,function(e){return n("li",[t._v("\n                                "+t._s(e)+"\n                            ")])}),0)]):t._e(),t._v(" "),n("form",{staticClass:"form-horizontal",attrs:{role:"form"}},[n("div",{staticClass:"form-group"},[n("label",{staticClass:"col-md-3 control-label"},[t._v("Name")]),t._v(" "),n("div",{staticClass:"col-md-7"},[n("input",{directives:[{name:"model",rawName:"v-model",value:t.createForm.name,expression:"createForm.name"}],staticClass:"form-control",attrs:{id:"create-client-name",type:"text"},domProps:{value:t.createForm.name},on:{keyup:function(e){return!e.type.indexOf("key")&&t._k(e.keyCode,"enter",13,e.key,"Enter")?null:t.store(e)},input:function(e){e.target.composing||t.$set(t.createForm,"name",e.target.value)}}}),t._v(" "),n("span",{staticClass:"help-block"},[t._v("\n                                    Something your users will recognize and trust.\n                                ")])])]),t._v(" "),n("div",{staticClass:"form-group"},[n("label",{staticClass:"col-md-3 control-label"},[t._v("Redirect URL")]),t._v(" "),n("div",{staticClass:"col-md-7"},[n("input",{directives:[{name:"model",rawName:"v-model",value:t.createForm.redirect,expression:"createForm.redirect"}],staticClass:"form-control",attrs:{type:"text",name:"redirect"},domProps:{value:t.createForm.redirect},on:{keyup:function(e){return!e.type.indexOf("key")&&t._k(e.keyCode,"enter",13,e.key,"Enter")?null:t.store(e)},input:function(e){e.target.composing||t.$set(t.createForm,"redirect",e.target.value)}}}),t._v(" "),n("span",{staticClass:"help-block"},[t._v("\n                                    Your application's authorization callback URL.\n                                ")])])])])]),t._v(" "),n("div",{staticClass:"modal-footer"},[n("button",{staticClass:"btn btn-default",attrs:{type:"button","data-dismiss":"modal"}},[t._v("Close")]),t._v(" "),n("button",{staticClass:"btn btn-primary",attrs:{type:"button"},on:{click:t.store}},[t._v("\n                        Create\n                    ")])])])])]),t._v(" "),n("div",{staticClass:"modal fade",attrs:{id:"modal-edit-client",tabindex:"-1",role:"dialog"}},[n("div",{staticClass:"modal-dialog"},[n("div",{staticClass:"modal-content"},[t._m(3),t._v(" "),n("div",{staticClass:"modal-body"},[t.editForm.errors.length>0?n("div",{staticClass:"alert alert-danger"},[t._m(4),t._v(" "),n("br"),t._v(" "),n("ul",t._l(t.editForm.errors,function(e){return n("li",[t._v("\n                                "+t._s(e)+"\n                            ")])}),0)]):t._e(),t._v(" "),n("form",{staticClass:"form-horizontal",attrs:{role:"form"}},[n("div",{staticClass:"form-group"},[n("label",{staticClass:"col-md-3 control-label"},[t._v("Name")]),t._v(" "),n("div",{staticClass:"col-md-7"},[n("input",{directives:[{name:"model",rawName:"v-model",value:t.editForm.name,expression:"editForm.name"}],staticClass:"form-control",attrs:{id:"edit-client-name",type:"text"},domProps:{value:t.editForm.name},on:{keyup:function(e){return!e.type.indexOf("key")&&t._k(e.keyCode,"enter",13,e.key,"Enter")?null:t.update(e)},input:function(e){e.target.composing||t.$set(t.editForm,"name",e.target.value)}}}),t._v(" "),n("span",{staticClass:"help-block"},[t._v("\n                                    Something your users will recognize and trust.\n                                ")])])]),t._v(" "),n("div",{staticClass:"form-group"},[n("label",{staticClass:"col-md-3 control-label"},[t._v("Redirect URL")]),t._v(" "),n("div",{staticClass:"col-md-7"},[n("input",{directives:[{name:"model",rawName:"v-model",value:t.editForm.redirect,expression:"editForm.redirect"}],staticClass:"form-control",attrs:{type:"text",name:"redirect"},domProps:{value:t.editForm.redirect},on:{keyup:function(e){return!e.type.indexOf("key")&&t._k(e.keyCode,"enter",13,e.key,"Enter")?null:t.update(e)},input:function(e){e.target.composing||t.$set(t.editForm,"redirect",e.target.value)}}}),t._v(" "),n("span",{staticClass:"help-block"},[t._v("\n                                    Your application's authorization callback URL.\n                                ")])])])])]),t._v(" "),n("div",{staticClass:"modal-footer"},[n("button",{staticClass:"btn btn-default",attrs:{type:"button","data-dismiss":"modal"}},[t._v("Close")]),t._v(" "),n("button",{staticClass:"btn btn-primary",attrs:{type:"button"},on:{click:t.update}},[t._v("\n                        Save Changes\n                    ")])])])])])])},staticRenderFns:[function(){var t=this.$createElement,e=this._self._c||t;return e("thead",[e("tr",[e("th",[this._v("Client ID")]),this._v(" "),e("th",[this._v("Name")]),this._v(" "),e("th",[this._v("Secret")]),this._v(" "),e("th"),this._v(" "),e("th")])])},function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"modal-header"},[e("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"modal","aria-hidden":"true"}},[this._v("×")]),this._v(" "),e("h4",{staticClass:"modal-title"},[this._v("\n                        Create Client\n                    ")])])},function(){var t=this.$createElement,e=this._self._c||t;return e("p",[e("strong",[this._v("Whoops!")]),this._v(" Something went wrong!")])},function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"modal-header"},[e("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"modal","aria-hidden":"true"}},[this._v("×")]),this._v(" "),e("h4",{staticClass:"modal-title"},[this._v("\n                        Edit Client\n                    ")])])},function(){var t=this.$createElement,e=this._self._c||t;return e("p",[e("strong",[this._v("Whoops!")]),this._v(" Something went wrong!")])}]}},rjj0:function(t,e,n){var s="undefined"!=typeof document;if("undefined"!=typeof DEBUG&&DEBUG&&!s)throw new Error("vue-style-loader cannot be used in a non-browser environment. Use { target: 'node' } in your Webpack config to indicate a server-rendering environment.");var o=n("tTVk"),a={},i=s&&(document.head||document.getElementsByTagName("head")[0]),r=null,c=0,l=!1,d=function(){},u=null,v="data-vue-ssr-id",m="undefined"!=typeof navigator&&/msie [6-9]\b/.test(navigator.userAgent.toLowerCase());function p(t){for(var e=0;e<t.length;e++){var n=t[e],s=a[n.id];if(s){s.refs++;for(var o=0;o<s.parts.length;o++)s.parts[o](n.parts[o]);for(;o<n.parts.length;o++)s.parts.push(h(n.parts[o]));s.parts.length>n.parts.length&&(s.parts.length=n.parts.length)}else{var i=[];for(o=0;o<n.parts.length;o++)i.push(h(n.parts[o]));a[n.id]={id:n.id,refs:1,parts:i}}}}function f(){var t=document.createElement("style");return t.type="text/css",i.appendChild(t),t}function h(t){var e,n,s=document.querySelector("style["+v+'~="'+t.id+'"]');if(s){if(l)return d;s.parentNode.removeChild(s)}if(m){var o=c++;s=r||(r=f()),e=b.bind(null,s,o,!1),n=b.bind(null,s,o,!0)}else s=f(),e=function(t,e){var n=e.css,s=e.media,o=e.sourceMap;s&&t.setAttribute("media",s);u.ssrId&&t.setAttribute(v,e.id);o&&(n+="\n/*# sourceURL="+o.sources[0]+" */",n+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(o))))+" */");if(t.styleSheet)t.styleSheet.cssText=n;else{for(;t.firstChild;)t.removeChild(t.firstChild);t.appendChild(document.createTextNode(n))}}.bind(null,s),n=function(){s.parentNode.removeChild(s)};return e(t),function(s){if(s){if(s.css===t.css&&s.media===t.media&&s.sourceMap===t.sourceMap)return;e(t=s)}else n()}}t.exports=function(t,e,n,s){l=n,u=s||{};var i=o(t,e);return p(i),function(e){for(var n=[],s=0;s<i.length;s++){var r=i[s];(c=a[r.id]).refs--,n.push(c)}e?p(i=o(t,e)):i=[];for(s=0;s<n.length;s++){var c;if(0===(c=n[s]).refs){for(var l=0;l<c.parts.length;l++)c.parts[l]();delete a[c.id]}}}};var _,C=(_=[],function(t,e){return _[t]=e,_.filter(Boolean).join("\n")});function b(t,e,n,s){var o=n?"":s.css;if(t.styleSheet)t.styleSheet.cssText=C(e,o);else{var a=document.createTextNode(o),i=t.childNodes;i[e]&&t.removeChild(i[e]),i.length?t.insertBefore(a,i[e]):t.appendChild(a)}}},tTVk:function(t,e){t.exports=function(t,e){for(var n=[],s={},o=0;o<e.length;o++){var a=e[o],i=a[0],r={id:t+":"+o,css:a[1],media:a[2],sourceMap:a[3]};s[i]?s[i].parts.push(r):n.push(s[i]={id:i,parts:[r]})}return n}},v2Db:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[t.tokens.length>0?n("div",[n("div",{staticClass:"panel panel-default"},[n("div",{staticClass:"panel-heading"},[t._v("Authorized Applications")]),t._v(" "),n("div",{staticClass:"panel-block"},[n("table",{staticClass:"table table-borderless m-b-none"},[t._m(0),t._v(" "),n("tbody",t._l(t.tokens,function(e){return n("tr",[n("td",{staticStyle:{"vertical-align":"middle"}},[t._v("\n                                "+t._s(e.client.name)+"\n                            ")]),t._v(" "),n("td",{staticStyle:{"vertical-align":"middle"}},[e.scopes.length>0?n("span",[t._v("\n                                    "+t._s(e.scopes.join(", "))+"\n                                ")]):t._e()]),t._v(" "),n("td",{staticStyle:{"vertical-align":"middle"}},[n("a",{staticClass:"action-link text-danger",on:{click:function(n){return t.revoke(e)}}},[t._v("\n                                    Revoke\n                                ")])])])}),0)])])])]):t._e()])},staticRenderFns:[function(){var t=this.$createElement,e=this._self._c||t;return e("thead",[e("tr",[e("th",[this._v("Name")]),this._v(" "),e("th",[this._v("Scopes")]),this._v(" "),e("th")])])}]}}});