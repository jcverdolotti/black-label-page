import React from 'react';
import {Link} from 'react-router-dom';
function Plataforma(props) {

	return (
		<div className='contenedor-pg'>
			<p className='nombre-pg'> {props.nombre} </p>
			<div>
				<Link to={"/plataformas/edit/"+props.id} id='button'>EDITAR</Link>
				<Link to={"/plataformas/delete/"+props.id+"/"+props.nombre} id='button' >BORRAR</Link>
			</div>
		</div>
		);
}

export default Plataforma;