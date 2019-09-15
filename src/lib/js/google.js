function googleTranslateElementInit() {
	new google.translate.TranslateElement({
		pageLanguage: 'bd,be,bf,bg,ba,bb,wf,bl,bm,bn,bo,bh,bi,bj,bt,jm,bv,bw,ws,bq,br,bs,je,by,bz,ru,rw,rs,tl,re,tm,tj,ro,tk,gw,gu,gt,gs,gr,gq,gp,jp,gy,gg,gf,ge,gd,gb,ga,sv,gn,gm,gl,gi,gh,om,tn,jo,hr,ht,hu,hk,hn,hm,ve,pr,ps,pw,pt,sj,py,iq,pa,pf,pg,pe,pk,ph,pn,pl,pm,zm,eh,ee,eg,za,ec,it,vn,sb,et,so,zw,sa,es,er,me,md,mg,mf,ma,mc,uz,mm,ml,mo,mn,mh,mk,mu,mt,mw,mv,mq,mp,ms,mr,im,ug,tz,my,mx,il,fr,io,sh,fi,fj,fk,fm,fo,ni,nl,no,na,vu,nc,ne,nf,ng,nz,np,nr,nu,ck,xk,ci,ch,co,cn,cm,cl,cc,ca,cg,cf,cd,cz,cy,cx,cr,cw,cv,cu,sz,sy,sx,kg,ke,ss,sr,ki,kh,kn,km,st,sk,kr,si,kp,kw,sn,sm,sl,sc,kz,ky,sg,se,sd,do,dm,dj,dk,vg,de,ye,dz,us,uy,yt,um,lb,lc,la,tv,tw,tt,tr,lk,li,lv,to,lt,lu,lr,ls,th,tf,tg,td,tc,ly,va,vc,ae,ad,ag,af,ai,vi,is,ir,am,al,ao,aq,as,ar,au,at,aw,in,ax,az,ie,id,ua,qa,mz',
		includedLanguages: 'bd,be,bf,bg,ba,bb,wf,bl,bm,bn,bo,bh,bi,bj,bt,jm,bv,bw,ws,bq,br,bs,je,by,bz,ru,rw,rs,tl,re,tm,tj,ro,tk,gw,gu,gt,gs,gr,gq,gp,jp,gy,gg,gf,ge,gd,gb,ga,sv,gn,gm,gl,gi,gh,om,tn,jo,hr,ht,hu,hk,hn,hm,ve,pr,ps,pw,pt,sj,py,iq,pa,pf,pg,pe,pk,ph,pn,pl,pm,zm,eh,ee,eg,za,ec,it,vn,sb,et,so,zw,sa,es,er,me,md,mg,mf,ma,mc,uz,mm,ml,mo,mn,mh,mk,mu,mt,mw,mv,mq,mp,ms,mr,im,ug,tz,my,mx,il,fr,io,sh,fi,fj,fk,fm,fo,ni,nl,no,na,vu,nc,ne,nf,ng,nz,np,nr,nu,ck,xk,ci,ch,co,cn,cm,cl,cc,ca,cg,cf,cd,cz,cy,cx,cr,cw,cv,cu,sz,sy,sx,kg,ke,ss,sr,ki,kh,kn,km,st,sk,kr,si,kp,kw,sn,sm,sl,sc,kz,ky,sg,se,sd,do,dm,dj,dk,vg,de,ye,dz,us,uy,yt,um,lb,lc,la,tv,tw,tt,tr,lk,li,lv,to,lt,lu,lr,ls,th,tf,tg,td,tc,ly,va,vc,ae,ad,ag,af,ai,vi,is,ir,am,al,ao,aq,as,ar,au,at,aw,in,ax,az,ie,id,ua,qa,mz',
		autoDisplay: false,
		layout: google.translate.TranslateElement.InlineLayout.SIMPLE
	}, 'google_translate_element');
	$("#google_translate_element img").eq(0).remove();

	function changeGoogleStyles() {
		if ($('.goog-te-menu-frame').contents().find('.goog-te-menu2').length) {
			$('.goog-te-menu-frame').contents().find('.goog-te-menu2').css({
				'max-width': '100%',
				'overflow-x': 'auto',
				'box-sizing': 'border-box',
				'height': 'auto'
			});
	 
		} else {
			setTimeout(changeGoogleStyles, 50);
		}
	}
	changeGoogleStyles();
}
