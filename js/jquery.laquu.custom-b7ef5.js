/**
 * jQuery plugin laquu.
 *
 * @Auth    Nully
 * @Url
 * @Make    10/04/26(Mon)
 * @Version  1.2.5
 * @License MIT Lincense
 * The MIT License
 *
 * Copyright (c) 2010 <copyright Nully>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
if(!laquu)var laquu=jQuery.sub();laquu=laquu.extend({isUnderIE6:!!(laquu.browser.msie&&Math.abs(laquu.browser.version)<=6),empty:function(){},debug:function(){window.console&&console.log?console.log(arguments):this.error(arguments.slice(0,1))},toAbstolute:function(){return(document.createElement("span").innerHTML='<a href="'+p+'"></a>').firstChild.href},error:function(a){throw a;}});

(function(e){e.Toast={LENGTH_SHORT:800,LENGTH_LONG:1800,_defaults:{message:"AndroidOS\u98a8\u306eToast\u30e1\u30c3\u30bb\u30fc\u30b8\u901a\u77e5\u3067\u3059\u3002",showTime:2E3,fadeTime:800,position:"center-center"},_queues:[],isToasted:!1,show:function(d){var a=e.extend({},this._defaults,d||{});if(this.isToasted===!1){this.isToasted=!0;var c=this._createToastContainer(a.message,a.position),b=this;c.fadeIn(a.fadeTime,function(){var d=setTimeout(function(){c.fadeOut(a.fadeTime,function(){c.remove();
b.isToasted=!1;clearTimeout(d);b.hasQueue()&&b.show(b.getNextQueue())})},a.showTime)})}else this.pushQueue(a)},pushQueue:function(d){this._queues.push(d)},dequeue:function(){this.hasQueue()&&this._queues.shift()},dequeueAll:function(){this._queues.length=0},getNextQueue:function(){return this._queues.shift()},hasQueue:function(){return this._queues.length>=1},_createToastContainer:function(d,a){var c=e('<div class="laquu-toast-container"><p class="laquu-toast-message">'+d+"</p></div>").hide().appendTo("body");
props=this._getToastPosition(a);props.position="absolute";c.css(props);return c},_getToastPosition:function(d){if(typeof d!="string")return d;var a=e(window),c={},b=jQuery(".laquu-toast-container");switch(d){case "top-left":c.top=(b.outerHeight({margin:!0})-b.innerHeight())/2+a.scrollTop();c.left=(b.outerWidth({margin:!0})-b.innerWidth())/2+a.scrollLeft();break;case "top-center":c.top=(b.outerHeight({margin:!0})-b.innerHeight())/2+a.scrollTop();c.left=(a.width()-b.outerWidth())/2+a.scrollLeft();break;
case "top-right":c.top=(b.outerHeight({margin:!0})-b.innerHeight())/2+a.scrollTop();c.left=a.width()-b.outerWidth({margin:!0})*2+b.innerWidth()+a.scrollLeft();break;case "center-left":c.top=(a.height()-b.outerHeight())/2+a.scrollTop();c.left=(b.outerWidth({margin:!0})-b.innerWidth())/2+a.scrollLeft();break;case "center-right":c.top=(a.height()-b.outerHeight())/2+a.scrollTop();c.left=a.width()-b.outerWidth({margin:!0})*2+b.innerWidth()+a.scrollLeft();break;case "bottom-left":c.top=a.height()-b.outerHeight({margin:!0})*
2+b.innerHeight()+a.scrollTop();c.left=(b.outerWidth({margin:!0})-b.innerWidth())/2+a.scrollLeft();break;case "bottom-center":c.top=a.height()-b.outerHeight({margin:!0})*2+b.innerHeight()+a.scrollTop();c.left=(a.width()-b.outerWidth())/2+a.scrollLeft();break;case "bottom-right":c.top=a.height()-b.outerHeight({margin:!0})*2+b.innerHeight()+a.scrollTop();c.left=a.width()-b.outerWidth({margin:!0})*2+b.innerWidth()+a.scrollLeft();break;default:c.top=(a.height()-b.outerHeight())/2+a.scrollTop(),c.left=
(a.width()-b.outerWidth())/2+a.scrollLeft()}return c}}})(laquu);
