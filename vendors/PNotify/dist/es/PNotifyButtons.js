import PNotify from"./PNotify.js";function _showSticker({sticker:e,_notice:t}){return e&&!(t&&t.refs.elem.classList.contains("nonblock"))}function _showCloser({closer:e,_notice:t}){return e&&!(t&&t.refs.elem.classList.contains("nonblock"))}function _pinUpClass({classes:e,_notice:t}){return t?null===e.pinUp?t.get()._icons.pinUp:e.pinUp:""}function _pinDownClass({classes:e,_notice:t}){return t?null===e.pinDown?t.get()._icons.pinDown:e.pinDown:""}function _closerClass({classes:e,_notice:t}){return t?null===e.closer?t.get()._icons.closer:e.closer:""}function data(){return Object.assign({_notice:null,_options:{},_mouseIsIn:!1},PNotify.modules.Buttons.defaults)}var methods={initModule(e){this.set(e);const{_notice:t}=this.get();t.on("mouseenter",()=>this.set({_mouseIsIn:!0})),t.on("mouseleave",()=>this.set({_mouseIsIn:!1})),t.on("state",({changed:e,current:t})=>{if(!e.hide)return;const{sticker:s}=this.get();if(!s)return;const i=t.hide?this.get().classes.pinUp:this.get().classes.pinDown;("fontawesome5"===this.get()._notice.get().icons||"string"==typeof i&&i.match(/(^| )fa[srlb]($| )/))&&(this.set({sticker:!1}),this.set({sticker:!0}))})},handleStickerClick(){const{_notice:e}=this.get();e.update({hide:!e.get().hide})},handleCloserClick(){this.get()._notice.close(!1),this.set({_mouseIsIn:!1})}};function oncreate(){this.fire("init",{module:this})}function setup(e){e.key="Buttons",e.defaults={closer:!0,closerHover:!0,sticker:!0,stickerHover:!0,labels:{close:"Close",stick:"Stick",unstick:"Unstick"},classes:{closer:null,pinUp:null,pinDown:null}},PNotify.modules.Buttons=e,PNotify.modulesPrependContainer.push(e),Object.assign(PNotify.icons.brighttheme,{closer:"brighttheme-icon-closer",pinUp:"brighttheme-icon-sticker",pinDown:"brighttheme-icon-sticker brighttheme-icon-stuck"}),Object.assign(PNotify.icons.bootstrap3,{closer:"glyphicon glyphicon-remove",pinUp:"glyphicon glyphicon-pause",pinDown:"glyphicon glyphicon-play"}),Object.assign(PNotify.icons.fontawesome4,{closer:"fa fa-times",pinUp:"fa fa-pause",pinDown:"fa fa-play"}),Object.assign(PNotify.icons.fontawesome5,{closer:"fas fa-times",pinUp:"fas fa-pause",pinDown:"fas fa-play"})}function add_css(){var e=createElement("style");e.id="svelte-1yjle82-style",e.textContent=".ui-pnotify-closer.svelte-1yjle82,.ui-pnotify-sticker.svelte-1yjle82{float:right;margin-left:.5em;cursor:pointer}[dir=rtl] .ui-pnotify-closer.svelte-1yjle82,[dir=rtl] .ui-pnotify-sticker.svelte-1yjle82{float:left;margin-right:.5em;margin-left:0}.ui-pnotify-buttons-hidden.svelte-1yjle82{visibility:hidden}",append(document.head,e)}function create_main_fragment(e,t){var s,i,n=t._showCloser&&create_if_block_1(e,t),o=t._showSticker&&create_if_block(e,t);return{c(){n&&n.c(),s=createText("\n"),o&&o.c(),i=createComment()},m(e,t){n&&n.m(e,t),insert(e,s,t),o&&o.m(e,t),insert(e,i,t)},p(t,r){r._showCloser?n?n.p(t,r):((n=create_if_block_1(e,r)).c(),n.m(s.parentNode,s)):n&&(n.d(1),n=null),r._showSticker?o?o.p(t,r):((o=create_if_block(e,r)).c(),o.m(i.parentNode,i)):o&&(o.d(1),o=null)},d(e){n&&n.d(e),e&&detachNode(s),o&&o.d(e),e&&detachNode(i)}}}function create_if_block_1(e,t){var s,i,n,o;function r(t){e.handleCloserClick()}return{c(){s=createElement("div"),(i=createElement("span")).className=t._closerClass+" svelte-1yjle82",addListener(s,"click",r),s.className=n="ui-pnotify-closer "+(!t.closerHover||t._mouseIsIn?"":"ui-pnotify-buttons-hidden")+" svelte-1yjle82",setAttribute(s,"role","button"),s.tabIndex="0",s.title=o=t.labels.close},m(e,t){insert(e,s,t),append(s,i)},p(e,t){e._closerClass&&(i.className=t._closerClass+" svelte-1yjle82"),(e.closerHover||e._mouseIsIn)&&n!==(n="ui-pnotify-closer "+(!t.closerHover||t._mouseIsIn?"":"ui-pnotify-buttons-hidden")+" svelte-1yjle82")&&(s.className=n),e.labels&&o!==(o=t.labels.close)&&(s.title=o)},d(e){e&&detachNode(s),removeListener(s,"click",r)}}}function create_if_block(e,t){var s,i,n,o,r,c;function l(t){e.handleStickerClick()}return{c(){s=createElement("div"),(i=createElement("span")).className=n=(t._options.hide?t._pinUpClass:t._pinDownClass)+" svelte-1yjle82",addListener(s,"click",l),s.className=o="ui-pnotify-sticker "+(!t.stickerHover||t._mouseIsIn?"":"ui-pnotify-buttons-hidden")+" svelte-1yjle82",setAttribute(s,"role","button"),setAttribute(s,"aria-pressed",r=t._options.hide),s.tabIndex="0",s.title=c=t._options.hide?t.labels.stick:t.labels.unstick},m(e,t){insert(e,s,t),append(s,i)},p(e,t){(e._options||e._pinUpClass||e._pinDownClass)&&n!==(n=(t._options.hide?t._pinUpClass:t._pinDownClass)+" svelte-1yjle82")&&(i.className=n),(e.stickerHover||e._mouseIsIn)&&o!==(o="ui-pnotify-sticker "+(!t.stickerHover||t._mouseIsIn?"":"ui-pnotify-buttons-hidden")+" svelte-1yjle82")&&(s.className=o),e._options&&r!==(r=t._options.hide)&&setAttribute(s,"aria-pressed",r),(e._options||e.labels)&&c!==(c=t._options.hide?t.labels.stick:t.labels.unstick)&&(s.title=c)},d(e){e&&detachNode(s),removeListener(s,"click",l)}}}function PNotifyButtons(e){init(this,e),this._state=assign(data(),e.data),this._recompute({sticker:1,_notice:1,closer:1,classes:1},this._state),this._intro=!0,document.getElementById("svelte-1yjle82-style")||add_css(),this._fragment=create_main_fragment(this,this._state),this.root._oncreate.push(()=>{oncreate.call(this),this.fire("update",{changed:assignTrue({},this._state),current:this._state})}),e.target&&(this._fragment.c(),this._mount(e.target,e.anchor),flush(this))}function createElement(e){return document.createElement(e)}function append(e,t){e.appendChild(t)}function createText(e){return document.createTextNode(e)}function createComment(){return document.createComment("")}function insert(e,t,s){e.insertBefore(t,s)}function detachNode(e){e.parentNode.removeChild(e)}function addListener(e,t,s,i){e.addEventListener(t,s,i)}function setAttribute(e,t,s){null==s?e.removeAttribute(t):e.setAttribute(t,s)}function removeListener(e,t,s,i){e.removeEventListener(t,s,i)}function init(e,t){e._handlers=blankObject(),e._slots=blankObject(),e._bind=t._bind,e._staged={},e.options=t,e.root=t.root||e,e.store=t.store||e.root.store,t.root||(e._beforecreate=[],e._oncreate=[],e._aftercreate=[])}function assign(e,t){for(var s in t)e[s]=t[s];return e}function assignTrue(e,t){for(var s in t)e[s]=1;return e}function flush(e){e._lock=!0,callAll(e._beforecreate),callAll(e._oncreate),callAll(e._aftercreate),e._lock=!1}function destroy(e){this.destroy=noop,this.fire("destroy"),this.set=noop,this._fragment.d(!1!==e),this._fragment=null,this._state={}}function get(){return this._state}function fire(e,t){var s=e in this._handlers&&this._handlers[e].slice();if(s)for(var i=0;i<s.length;i+=1){var n=s[i];if(!n.__calling)try{n.__calling=!0,n.call(this,t)}finally{n.__calling=!1}}}function on(e,t){var s=this._handlers[e]||(this._handlers[e]=[]);return s.push(t),{cancel:function(){var e=s.indexOf(t);~e&&s.splice(e,1)}}}function set(e){this._set(assign({},e)),this.root._lock||flush(this.root)}function _set(e){var t=this._state,s={},i=!1;for(var n in e=assign(this._staged,e),this._staged={},e)this._differs(e[n],t[n])&&(s[n]=i=!0);i&&(this._state=assign(assign({},t),e),this._recompute(s,this._state),this._bind&&this._bind(s,this._state),this._fragment&&(this.fire("state",{changed:s,current:this._state,previous:t}),this._fragment.p(s,this._state),this.fire("update",{changed:s,current:this._state,previous:t})))}function _stage(e){assign(this._staged,e)}function _mount(e,t){this._fragment[this._fragment.i?"i":"m"](e,t||null)}function _differs(e,t){return e!=e?t==t:e!==t||e&&"object"==typeof e||"function"==typeof e}function blankObject(){return Object.create(null)}function callAll(e){for(;e&&e.length;)e.shift()()}function noop(){}assign(PNotifyButtons.prototype,{destroy:destroy,get:get,fire:fire,on:on,set:set,_set:_set,_stage:_stage,_mount:_mount,_differs:_differs}),assign(PNotifyButtons.prototype,methods),PNotifyButtons.prototype._recompute=function(e,t){(e.sticker||e._notice)&&this._differs(t._showSticker,t._showSticker=_showSticker(t))&&(e._showSticker=!0),(e.closer||e._notice)&&this._differs(t._showCloser,t._showCloser=_showCloser(t))&&(e._showCloser=!0),(e.classes||e._notice)&&(this._differs(t._pinUpClass,t._pinUpClass=_pinUpClass(t))&&(e._pinUpClass=!0),this._differs(t._pinDownClass,t._pinDownClass=_pinDownClass(t))&&(e._pinDownClass=!0),this._differs(t._closerClass,t._closerClass=_closerClass(t))&&(e._closerClass=!0))},setup(PNotifyButtons);export default PNotifyButtons;
//# sourceMappingURL=PNotifyButtons.js.map