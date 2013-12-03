var ImgObject = function(opt){
    this.init(opt);
}
ImgObject.prototype = {
    imglist:[],
    id:"",
    name:"",
    init:function(opt){
        this.name = opt.name;
        this.id = this.getRandom(5);
        this.imglist = opt.str.split(",");
    },
    getRandom:function(n){
        var rnd="";
        for(var i=0;i<n;i++)
        rnd+=Math.floor(Math.random()*10);
        return rnd;
    },
    getCheckItem:function(){
        var dom = document.getElementById(this.id),
                imgchecklist = [],
            ipts = dom.getElementsByTagName("input");
        for(var i=0,ipt;ipt=ipts[i++];){
            if(ipt.checked){
                imgchecklist.push(ipt.value);
            }
        }
        return imgchecklist;
    },
    createEl:function(tag){
        return document.createElement(tag);
    },
    getDataTpl:function(){
        var str = "";
        for(var i=0,img;img=this.imglist[i++];){
            str += '<div class="imgitem"><img src="'+img.replace(/_check/ig,"")+'" onerror="this.src=\'/Public/images/nopic.png\'" width="100px"><input name="'+this.name+'"  type="checkbox" '+(img.indexOf("_check")!=-1?"checked":"")+' value="'+img.replace(/.*_/ig,"")+'"></div>';
        }
        return str;
    },

    formatDom : function(){
        var html = '<div class="showimg" id="'+this.id+'">' +
                this.getDataTpl()+
                '</div>';
        return html;
    },
    render:function(id){
        var el = id?document.getElementById(id):document.body;
        el.innerHTML = this.formatDom();
    }
}
function typechange(obj){
	var type = obj.value,
	    etype = document.getElementById("etype");
	if(type==3){
		etype.innerHTML = "万元";
	}else{
		etype.innerHTML = "元/月";
	}
}