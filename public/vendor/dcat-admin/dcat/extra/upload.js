!function(e){var t={};function a(i){if(t[i])return t[i].exports;var r=t[i]={i:i,l:!1,exports:{}};return e[i].call(r.exports,r,r.exports,a),r.l=!0,r.exports}a.m=e,a.c=t,a.d=function(e,t,i){a.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:i})},a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},a.t=function(e,t){if(1&t&&(e=a(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var i=Object.create(null);if(a.r(i),Object.defineProperty(i,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)a.d(i,r,function(t){return e[t]}.bind(null,r));return i},a.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return a.d(t,"a",t),t},a.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},a.p="/",a(a.s=14)}({14:function(e,t,a){e.exports=a(17)},17:function(e,t,a){"use strict";function i(e,t){for(var a=0;a<t.length;a++){var i=t[a];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}a.r(t);var r=function(){function e(t){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.uploader=t,this.isSupportBase64=this.supportBase64()}var t,a,r;return t=e,(a=[{key:"supportBase64",value:function(){var e=new Image,t=!0;return e.onload=e.onerror=function(){1==this.width&&1==this.height||(t=!1)},e.src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==",t}},{key:"showError",value:function(e){var t="Unknown error!";e&&e.data&&(t=e.data.message||t),Dcat.error(t)}},{key:"orderFiles",value:function(e){var t=e.parents("li").first(),a=e.data("id"),i=e.data("order"),r=t.prev(),s=t.next();if(i){if(!r.length)return;return this.swrapUploadedFile(a,i),void this.uploader.reRenderUploadedFiles()}s.length&&(this.swrapUploadedFile(a,i),this.uploader.reRenderUploadedFiles())}},{key:"swrapUploadedFile",value:function(e,t){var a=this.uploader.addUploadedFile.uploadedFiles,i=parseInt(this.searchUploadedFile(e)),r=a[i],s=a[i-1],n=a[i+1];if(t){if(0===i)return;a[i-1]=r,a[i]=s}else{if(!n)return;a[i+1]=r,a[i]=n}this.setUploadedFilesToInput()}},{key:"setUploadedFilesToInput",value:function(){var e,t=this.uploader,a=t.addUploadedFile.uploadedFiles,i=[];for(e in a)a[e]&&i.push(a[e].serverId);t.input.set(i)}},{key:"searchUploadedFile",value:function(e){var t=this.uploader.addUploadedFile.uploadedFiles;for(var a in t)if(t[a].serverId===e)return a;return-1}}])&&i(t.prototype,a),r&&i(t,r),e}();function s(e,t){for(var a=0;a<t.length;a++){var i=t[a];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}var n=function(){function e(t){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.uploader=t}var t,a,i;return t=e,(a=[{key:"delete",value:function(e,t){var a=this.uploader,i=a.options,r=a.uploader;Dcat.confirm(a.lang.trans("confirm_delete_file"),e.serverId,(function(){var s=i.deleteData;if(s.key=e.serverId,!s.key)return a.input.delete(e.serverId),r.removeFile(e);s._column=a.getColumn(),s._relation=a.relation,Dcat.loading(),$.post({url:i.deleteUrl,data:s,success:function(e){Dcat.loading(!1),e.status?t(e):a.helper.showError(e)}})}))}},{key:"update",value:function(){var e=this.uploader,t=e.uploader,a=e.options,i=e.getColumn(),r=this.relation,s=e.input.get(),n=t.getStats().successNum,l=$.extend({},a.formData);if(n&&s&&a.autoUpdateColumn){if(r){if(!r[1])return;l[r[0]]={},l[r[0]][r[1]]={},l[r[0]][r[1]][i]=s.join(",")}else l[i]=s.join(",");delete l._relation,delete l.upload_column,$.post({url:a.updateServer,data:l})}}}])&&s(t.prototype,a),i&&s(t,i),e}();function l(e,t){for(var a=0;a<t.length;a++){var i=t[a];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}var o=function(){function e(t){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.uploader=t,this.$selector=t.$selector.find(t.options.inputSelector)}var t,a,i;return t=e,(a=[{key:"get",value:function(){var e=this.$selector.val();return e?e.split(","):[]}},{key:"add",value:function(e){var t=this.get();t.push(e),this.set(t)}},{key:"set",value:function(e){e=e.filter((function(e,t,a){return a.indexOf(e)===t})).filter((function(e){return!!e})),this.$selector.val(e.join(",")).trigger("change")}},{key:"delete",value:function(e){if(this.deleteUploadedFile(e),!e)return this.$selector.val("");this.set(this.get().filter((function(t){return t!=e})))}},{key:"deleteUploadedFile",value:function(e){var t=this.uploader.addUploadedFile;t.uploadedFiles=t.uploadedFiles.filter((function(t){return t.serverId!=e}))}},{key:"removeValidatorErrors",value:function(){this.$selector.parents(".form-group,.form-label-group,.form-field").find(".with-errors").html("")}}])&&l(t.prototype,a),i&&l(t,i),e}();function d(e,t){for(var a=0;a<t.length;a++){var i=t[a];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}var u=function(){function e(t){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.uploader=t,this.state="pending",this.originalFilesNum=Dcat.helpers.len(t.options.preview)}var t,a,i;return t=e,(a=[{key:"switch",value:function(e,t){var a=this.uploader;if(t=t||{},e!==this.state){switch(a.$uploadButton&&(a.$uploadButton.removeClass("state-"+this.state),a.$uploadButton.addClass("state-"+e)),this.state=e,this.state){case"pending":this.pending();break;case"ready":this.ready();break;case"uploading":this.uploading();break;case"paused":this.paused();break;case"confirm":this.confirm();break;case"finish":this.finish();break;case"decrOriginalFileNum":this.decrOriginalFileNum();break;case"incrOriginalFileNum":this.incrOriginalFileNum();break;case"decrFileNumLimit":this.decrFileNumLimit(t.num);break;case"incrFileNumLimit":this.incrFileNumLimit(t.num||1);break;case"init":this.init()}this.updateStatusText()}}},{key:"incrOriginalFileNum",value:function(){this.originalFilesNum++}},{key:"decrOriginalFileNum",value:function(){this.originalFilesNum>0&&this.originalFilesNum--}},{key:"confirm",value:function(){var e,t=this.uploader,a=t.uploader;a&&(t.$progress.hide(),t.$selector.find(t.options.addFileButton).removeClass("element-invisible"),t.$uploadButton.text(t.lang.trans("start_upload")),(e=a.getStats()).successNum&&!e.uploadFailNum&&this.switch("finish"))}},{key:"paused",value:function(){var e=this.uploader;e.$progress.show(),e.$uploadButton.text(e.lang.trans("go_on_upload"))}},{key:"uploading",value:function(){var e=this.uploader;e.$selector.find(e.options.addFileButton).addClass("element-invisible"),e.$progress.show(),e.$uploadButton.text(e.lang.trans("pause_upload"))}},{key:"pending",value:function(){var e=this.uploader;e.options.disabled||(e.$placeholder.removeClass("element-invisible"),e.$files.hide(),e.$statusBar.addClass("element-invisible"),e.isImage()&&(e.$wrapper.removeAttr("style"),e.$wrapper.find(".queueList").removeAttr("style")),e.uploader.refresh())}},{key:"decrFileNumLimit",value:function(e){var t,a=this.uploader.uploader;a&&("-1"==(t=a.option("fileNumLimit"))&&(t=0),0==(e=t>=(e=e||1)?t-e:0)&&(e="-1"),a.option("fileNumLimit",e))}},{key:"incrFileNumLimit",value:function(e){var t,a=this.uploader.uploader;a&&("-1"==(t=a.option("fileNumLimit"))&&(t=0),e=t+(e=e||1),a.option("fileNumLimit",e))}},{key:"ready",value:function(){var e=this.uploader,t=e.options;e.$placeholder.addClass("element-invisible"),e.$selector.find(e.options.addFileButton).removeClass("element-invisible"),e.$files.show(),t.disabled||e.$statusBar.removeClass("element-invisible"),e.uploader.refresh(),e.isImage()&&e.$wrapper.find(".queueList").css({border:"1px solid #d3dde5",padding:"5px"}),setTimeout((function(){e.input.removeValidatorErrors()}),10)}},{key:"finish",value:function(){var e,t=this.uploader,a=t.options,i=t.uploader;i&&((e=i.getStats()).successNum?(Dcat.success(t.lang.trans("upload_success_message",{success:e.successNum})),setTimeout((function(){1==a.upload.fileNumLimit&&(i.request("get-stats").numOfSuccess=0)}),10)):(this.state="done",Dcat.reload()))}},{key:"init",value:function(){var e=this.uploader,t=e.options;e.$uploadButton.addClass("state-"+this.state),this.updateProgress(),this.originalFilesNum||t.disabled?(e.$placeholder.addClass("element-invisible"),t.disabled?e.$wrapper.addClass("disabled"):e.$statusBar.show(),this.switch("ready")):e.isImage()&&(e.$wrapper.removeAttr("style"),e.$wrapper.find(".queueList").css("margin","0")),e.uploader.refresh()}},{key:"updateStatusText",value:function(){var e,t=this.uploader,a=t.uploader,i=t.lang.trans.bind(t.lang),r="";function s(){(e=a.getStats()).successNum&&(r=i("selected_success",{num:t.fileCount,size:WebUploader.formatSize(t.fileSize),success:e.successNum})),e.uploadFailNum&&(r+=(r?i("dot"):"")+i("failed_num",{fail:e.uploadFailNum}))}a&&("ready"===this.state?(e=a.getStats(),t.fileCount?r=i("selected_files",{num:t.fileCount,size:WebUploader.formatSize(t.fileSize)}):s()):"confirm"===this.state?(e=a.getStats()).uploadFailNum&&(r=i("selected_has_failed",{success:e.successNum,fail:e.uploadFailNum})):s(),t.$infoBox.html(r))}},{key:"updateProgress",value:function(){var e,t=this.uploader,a=0,i=0,r=t.$progress.find(".progress-bar");$.each(t.percentages,(function(e,t){i+=t[0],a+=t[0]*t[1]})),e=i?a/i:0,e=Math.round(100*e)+"%",r.text(e),r.css("width",e),this.updateStatusText()}}])&&d(t.prototype,a),i&&d(t,i),e}();function c(e,t){for(var a=0;a<t.length;a++){var i=t[a];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}var p=function(){function e(t){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.uploader=t}var t,a,i;return t=e,(a=[{key:"render",value:function(e){var t,a,i=this.uploader,r=i.isImage(),s=WebUploader.formatSize(e.size),n=e.name||null;r?(t=$('<li id="'.concat(i.getFileViewSelector(e.id),'" title="').concat(n,'" >\n                    <p class="file-type">').concat(e.ext.toUpperCase()||"FILE",'</p>\n                    <p class="imgWrap "></p>\n                    <p class="title" style="">').concat(e.name,'</p>\n                    <p class="title" style="margin-bottom:20px;">(<b>').concat(s,"</b>)</p>\n                    </li>")),a=$('<div class="file-panel">\n                    <a class="btn btn-sm btn-white" data-file-act="cancel"><i class="feather icon-x red-dark" style="font-size:13px"></i></a>\n                    <a class="btn btn-sm btn-white" data-file-act="delete" style="display: none">\n                    <i class="feather icon-trash red-dark" style="font-size:13px"></i></a>\n                    <a class="btn btn-sm btn-white" data-file-act="preview" ><i class="feather icon-zoom-in"></i></a>\n                    <a class=\'btn btn-sm btn-white\' data-file-act=\'order\' data-order="1" style="display: none"><i class=\'feather icon-arrow-up\'></i></a>\n                    <a class=\'btn btn-sm btn-white\' data-file-act=\'order\' data-order="0" style="display: none"><i class=\'feather icon-arrow-down\'></i></a>\n\n                    </div>').appendTo(t)):(t=$('\n                    <li id="'.concat(i.getFileViewSelector(e.id),'" title="').concat(e.nam,'">\n                    <p class="title" style="display:block">\n                        <i class="feather icon-check green _success icon-success"></i>\n                        ').concat(e.name," (").concat(s,")\n                    </p>\n                    </li>\n                ")),a=$('\n<span style="right: 45px;" class="file-action d-none" data-file-act=\'order\' data-order="1"><i class=\'feather icon-arrow-up\'></i></span>\n<span style="right: 25px;" class="file-action d-none" data-file-act=\'order\' data-order="0"><i class=\'feather icon-arrow-down\'></i></span>\n<span data-file-act="cancel" class="file-action" style="font-size:13px">\n    <i class="feather icon-x red-dark"></i>\n</span>\n<span data-file-act="delete" class="file-action" style="display:none">\n    <i class="feather icon-trash red-dark"></i>\n</span>\n').appendTo(t)),t.appendTo(i.$files),setTimeout((function(){t.css({margin:"5px"})}),50),"invalid"===e.getStatus()?this.showError(t,e.statusText,e):(r&&this.showImage(t,e),i.percentages[e.id]=[e.size,0],e.rotation=0),e.on("statuschange",this.resolveStatusChangeCallback(t,a,e)),(r?a.find("a"):a).on("click",this.resolveActionsCallback(e))}},{key:"showError",value:function(e,t,a){var i=this.uploader.lang,r="",s=$('<p class="error"></p>');switch(t){case"exceed_size":r=i.trans("exceed_size");break;case"interrupt":r=i.trans("interrupt");break;default:r=i.trans("upload_failed")}this.uploader.faildFiles[a.id]=a,s.text(r).appendTo(e)}},{key:"showImage",value:function(e,t){var a=this,i=a.uploader.uploader,r=e.find("p.imgWrap"),s=i.makeThumb(t,(function(t,i){var s;if(r.empty(),t)return e.find(".title").show(),void e.find(".file-type").show();a.uploader.helper.isSupportBase64?(s=$('<img src="'+i+'">'),r.append(s)):e.find(".file-type").show()}));try{s.once("load",(function(){t._info=t._info||s.info(),t._meta=t._meta||s.meta();var e=t._info.width,r=t._info.height;if(!a.validateDimensions(t))return Dcat.error("The image dimensions is invalid."),i.removeFile(t),!1;s.resize(e,r)}))}catch(e){return setTimeout((function(){i.removeFile(t)}),10)}}},{key:"resolveStatusChangeCallback",value:function(e,t,a){var i=this,r=i.uploader;return function(s,n,l){"progress"===n||"queued"===n&&(t.find('[data-file-act="cancel"]').hide(),t.find('[data-file-act="delete"]').show()),"error"===s||"invalid"===s?(i.showError(e,a.statusText,a),r.percentages[a.id][1]=1):"interrupt"===s?i.showError(e,"interrupt",a):"queued"===s?r.percentages[a.id][1]=0:"progress"===s?i.removeError(e):"complete"===s&&(i.uploader.isImage()?e.append('<span class="success"><em></em><i class="feather icon-check"></i></span>'):e.find("._success").show()),e.removeClass("state-"+n).addClass("state-"+s)}}},{key:"resolveActionsCallback",value:function(e){var t=this.uploader,a=t.uploader,i=t.helper;return function(){switch($(this).data("file-act")){case"cancel":return void a.removeFile(e);case"deleteurl":case"delete":if(t.options.removable)return t.input.delete(e.serverId),a.removeFile(e);t.request.delete(e,(function(){t.input.delete(e.serverId),a.removeFile(e)}));break;case"preview":Dcat.helpers.previewImage(t.$wrapper.find("img").attr("src"),null,e.name);break;case"order":$(this).attr("data-id",e.serverId),i.orderFiles($(this))}}}},{key:"removeError",value:function(e){e.find(".error").remove()}},{key:"validateDimensions",value:function(e){var t=this.uploader,a=t.options,i=a.dimensions,r=e._info.width,s=e._info.height,n=Dcat.helpers.isset;return!(t.isImage()&&this.isImage(e)&&Dcat.helpers.len(a.dimensions)&&(n(i,"width")&&i.width!=r||n(i,"min_width")&&i.min_width>r||n(i,"max_width")&&i.max_width<r||n(i,"height")&&i.height!=s||n(i,"min_height")&&i.min_height>s||n(i,"max_height")&&i.max_height<s||n(i,"ratio")&&i.ratio!=r/s))}},{key:"isImage",value:function(e){return e.type.match(/^image/)}}])&&c(t.prototype,a),i&&c(t,i),e}();function f(e,t){for(var a=0;a<t.length;a++){var i=t[a];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}var h=function(){function e(t){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.uploader=t,this.uploadedFiles=[],this.init=!1}var t,a,i;return t=e,(a=[{key:"render",value:function(e){var t=this,a=t.uploader,i=a.options,r=a.isImage(),s="";s+="<li title='"+e.serverPath+"'>",!r&&i.sortable&&(s+='\n<p style="right: 45px" class="file-action" data-file-act=\'order\' data-order="1" data-id=\''.concat(e.serverId,"'><i class='feather icon-arrow-up'></i></p>\n<p style=\"right: 25px\" class=\"file-action\" data-file-act='order' data-order=\"0\" data-id='").concat(e.serverId,"'><i class='feather icon-arrow-down'></i></p>\n")),r?s+="<p class='imgWrap'><img src='".concat(e.serverUrl,"'></p>"):i.disabled||(s+='<p class="file-action" data-file-act="delete" data-id="'.concat(e.serverId,'"><i class="feather icon-trash red-dark"></i></p>')),s+="<p class='title' style=''><i class='feather icon-check text-white icon-success text-white'></i>",s+=e.serverPath,s+="</p>",r&&(s+="<p class='title' style='margin-bottom:20px;'>&nbsp;</p>",s+="<div class='file-panel' >",i.disabled||(s+="<a class='btn btn-sm btn-white' data-file-act='deleteurl' data-id='".concat(e.serverId,"'><i class='feather icon-trash red-dark' style='font-size:13px'></i></a>")),s+="<a class='btn btn-sm btn-white' data-file-act='preview' data-url='".concat(e.serverUrl,"' ><i class='feather icon-zoom-in'></i></a>"),i.sortable&&(s+="\n<a class='btn btn-sm btn-white' data-file-act='order' data-order=\"1\" data-id='".concat(e.serverId,"'><i class='feather icon-arrow-up'></i></a>\n<a class='btn btn-sm btn-white' data-file-act='order' data-order=\"0\" data-id='").concat(e.serverId,"'><i class='feather icon-arrow-down'></i></a>\n")),s+="</div>"),s+="</li>",s=$(s),r||(s.find(".file-type").show(),s.find(".title").show(),a.$wrapper.css("background","transparent"));var n=function(){var e=$(this).data("id");if(i.removable)return s.remove(),t.removeFormFile(e);a.request.delete({serverId:e},(function(){s.remove(),t.removeFormFile(e)}))};s.find('[data-file-act="deleteurl"]').click(n),s.find('[data-file-act="delete"]').click(n),i.sortable&&s.find('[data-file-act="order"').click((function(){a.helper.orderFiles($(this))})),s.find('[data-file-act="preview"]').click((function(){var e=$(this).data("url");Dcat.helpers.previewImage(e)})),a.formFiles[e.serverId]=e,a.input.add(e.serverId),a.$files.append(s),r&&(setTimeout((function(){s.css("margin","5px")}),t.init?0:400),t.init=1)}},{key:"reRender",value:function(){for(var e in this.uploadedFiles)this.uploadedFiles[e]&&this.render(this.uploadedFiles[e])}},{key:"removeFormFile",value:function(e){if(e){var t=this.uploader,a=this.uploader,i=t.formFiles[e];t.input.delete(e),delete t.formFiles[e],a&&!i.fake&&a.removeFile(i),t.status.switch("decrOriginalFileNum"),t.status.switch("incrFileNumLimit"),Dcat.helpers.len(t.formFiles)||Dcat.helpers.len(t.percentages)||t.status.switch("pending")}}},{key:"add",value:function(e){e.serverId&&-1===this.uploader.helper.searchUploadedFile(e.serverId)&&this.uploadedFiles.push(e)}}])&&f(t.prototype,a),i&&f(t,i),e}();function m(e,t){for(var a=0;a<t.length;a++){var i=t[a];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(e,i.key,i)}}!function(e,t){var a=e.Dcat,i=function(){function e(i){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),this.options=i=t.extend({wrapper:".web-uploader",addFileButton:".add-file-button",inputSelector:"",isImage:!1,preview:[],server:"",updateServer:"",autoUpload:!1,sortable:!1,deleteUrl:"",deleteData:{},thumbHeight:160,elementName:"",disabled:!1,autoUpdateColumn:!1,removable:!1,dimensions:{},lang:{exceed_size:"文件大小超出",interrupt:"上传暂停",upload_failed:"上传失败，请重试",selected_files:"选中:num个文件，共:size。",selected_has_failed:'已成功上传:success个文件，:fail个文件上传失败，<a class="retry"  href="javascript:"";">重新上传</a>失败文件或<a class="ignore" href="javascript:"";">忽略</a>',selected_success:"共:num个(:size)，已上传:success个。",dot:"，",failed_num:"失败:fail个。",pause_upload:"暂停上传",go_on_upload:"继续上传",start_upload:"开始上传",upload_success_message:"已成功上传:success个文件",go_on_add:"继续添加",Q_TYPE_DENIED:"对不起，不允许上传此类型文件",Q_EXCEED_NUM_LIMIT:"对不起，已超出文件上传数量限制，最多只能上传:num个文件",F_EXCEED_SIZE:"对不起，当前选择的文件过大",Q_EXCEED_SIZE_LIMIT:"对不起，已超出文件大小限制",F_DUPLICATE:"文件重复",confirm_delete_file:"您确定要删除这个文件吗？"},upload:{formData:{_id:null},thumb:{width:160,height:160,quality:70,allowMagnify:!0,crop:!0,preserveHeaders:!1,type:"image/jpeg"}}},i);this.uploader=WebUploader.create(i.upload),this.$selector=t(i.selector),this.updateColumn=i.upload.formData.upload_column||"webup"+a.helpers.random(),this.relation=i.upload.formData._relation;var s=new r(this),l=new n(this),d=new u(this),c=new p(this),f=new h(this),m=new o(this);this.helper=s,this.request=l,this.status=d,this.addFile=c,this.addUploadedFile=f,this.input=m,this.lang=a.Translator(i.lang),this.percentages={},this.faildFiles={},this.formFiles={},this.fileCount=0,this.fileSize=0,void 0!==i.upload.formData._id&&i.upload.formData._id||(i.upload.formData._id=this.updateColumn+a.helpers.random())}var i,s,l;return i=e,(s=[{key:"build",value:function(){var e=this,i=e.uploader,r=e.options,s=e.$selector.find(r.wrapper),n=t('<ul class="filelist"></ul>').appendTo(s.find(".queueList")),l=s.find(".statusBar"),o=l.find(".info"),d=s.find(".upload-btn"),u=s.find(".placeholder"),c=l.find(".upload-progress").hide();e.$wrapper=s,e.$files=n,e.$statusBar=l,e.$uploadButton=d,e.$placeholder=u,e.$progress=c,e.$infoBox=o,r.upload.fileNumLimit>1&&!r.disabled&&i.addButton({id:r.addFileButton,label:'<i class="feather icon-folder"></i> &nbsp;'+e.lang.trans("go_on_add")}),e.uploader.on("dndAccept",(function(e){for(var t=!1,a=e.length,i=0;i<a;i++)if(~"text/plain;application/javascript ".indexOf(e[i].type)){t=!0;break}return!t})),i.onUploadProgress=function(t,a){e.percentages[t.id][1]=a,e.status.updateProgress()},i.onFileQueued=function(t){e.fileCount++,e.fileSize+=t.size,1===e.fileCount&&(u.addClass("element-invisible"),l.show()),e.addFile.render(t),e.status.switch("ready"),e.status.updateProgress(),!r.disabled&&r.autoUpload&&i.upload()},i.onFileDequeued=function(t){e.fileCount--,e.fileSize-=t.size,e.fileCount||a.helpers.len(e.formFiles)||e.status.switch("pending"),e.removeUploadFile(t)},i.on("all",(function(t,a,i){switch(t){case"uploadFinished":e.status.switch("confirm"),e.request.update();break;case"startUpload":e.status.switch("uploading");break;case"stopUpload":e.status.switch("paused");break;case"uploadAccept":if(!1===e._uploadAccept(a,i))return!1}})),i.onError=function(t){switch(t){case"Q_TYPE_DENIED":a.error(e.lang.trans("Q_TYPE_DENIED"));break;case"Q_EXCEED_NUM_LIMIT":a.error(e.lang.trans("Q_EXCEED_NUM_LIMIT",{num:r.upload.fileNumLimit}));break;case"F_EXCEED_SIZE":a.error(e.lang.trans("F_EXCEED_SIZE"));break;case"Q_EXCEED_SIZE_LIMIT":a.error(e.lang.trans("Q_EXCEED_SIZE_LIMIT"));break;case"F_DUPLICATE":a.warning(e.lang.trans("F_DUPLICATE"));break;default:a.error("Error: "+t)}},d.on("click",(function(){var a=e.status.state;if(t(this).hasClass("disabled"))return!1;"ready"===a||"paused"===a?i.upload():"uploading"===a&&i.stop()})),o.on("click",".retry",(function(){i.retry()})),o.on("click",".ignore",(function(){for(var t in e.faildFiles)i.removeFile(t,!0),delete e.faildFiles[t]})),e.status.switch("init")}},{key:"_uploadAccept",value:function(e,t){var a=this.options;if(!t||!t.status)return this.helper.showError(t),this.faildFiles[e.file.id]=e.file,!1;if(!t.data||!t.data.merge){e.file.serverId=t.data.id,e.file.serverName=t.data.name,e.file.serverPath=t.data.path,e.file.serverUrl=t.data.url||null,this.addUploadedFile.add(e.file),this.input.add(t.data.id);var i=this.getFileView(e.file.id);this.isImage()||(i.find(".file-action").hide(),i.find('[data-file-act="delete"]').show()),a.sortable&&i.find('[data-file-act="order"]').removeClass("d-none").show()}}},{key:"preview",value:function(){var e,t=this.options;for(e in t.preview){var a=t.preview[e].path,i=void 0;a.indexOf(".")&&(i=a.split(".").pop());var r={serverId:t.preview[e].id,serverUrl:t.preview[e].url,serverPath:a,ext:i,fake:1};this.status.switch("incrOriginalFileNum"),this.status.switch("decrFileNumLimit"),this.addUploadedFile.render(r),this.addUploadedFile.add(r)}}},{key:"reRenderUploadedFiles",value:function(){this.$files.html(""),this.addUploadedFile.reRender()}},{key:"refreshButton",value:function(){this.uploader.refresh()}},{key:"getFileViewSelector",value:function(e){return this.options.elementName.replace(/[\[\]]*/g,"_")+"-"+e}},{key:"getFileView",value:function(e){return t("#"+this.getFileViewSelector(e))}},{key:"removeUploadFile",value:function(e){var t=this.getFileView(e.id);delete this.percentages[e.id],this.status.updateProgress(),t.off().find(".file-panel").off().end().remove()}},{key:"getColumn",value:function(){return this.updateColumn}},{key:"isImage",value:function(){return this.options.isImage}}])&&m(i.prototype,s),l&&m(i,l),e}();a.Uploader=function(e){return new i(e)}}(window,jQuery)}});
//# sourceMappingURL=upload.js.map