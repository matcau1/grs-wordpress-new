(function(){
  const topButton=document.querySelector('.to-top');
  if(topButton){topButton.addEventListener('click',()=>window.scrollTo({top:0,behavior:'smooth'}));}
  document.querySelectorAll('[data-calculator="cooling-power"]').forEach((el)=>{
    el.addEventListener('input',()=>{const v=Number(el.querySelector('[data-volume]').value||0);const d=Number(el.querySelector('[data-delta]').value||0);el.querySelector('output').textContent=Math.max(0,(v*d*0.0012).toFixed(2))+' кВт';});
  });
  document.querySelectorAll('[data-calculator="pressure"]').forEach((el)=>{
    el.addEventListener('input',()=>{const bar=Number(el.querySelector('[data-bar]').value||0);el.querySelector('output').textContent=(bar*0.1).toFixed(3)+' МПа';});
  });
})();
