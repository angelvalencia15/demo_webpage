function get_username(){
	const cookie = document.cookie;
  const name = 'username';
 	const nvs = cookie.split('; ');
  
  if(name != ''){
  	for (const nv of nvs){
    	if(nv.startsWith(name + '=')){
      	return nv.substring(name.length + 1);
      }
    }
  }
  else{
  	for (const nv of nvs){
    	if(!nv.includes('=')){
      	return nv;
      }
    }
  }
  return '';
}

