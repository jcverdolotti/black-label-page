import React from 'react';
import Blacklabel from '../images/Blacklabel.png';

function HeaderComponent(){
    return (
        <header>
			<img id="imgCabecera" src={Blacklabel}/>
		</header>
    );
}

export default HeaderComponent;