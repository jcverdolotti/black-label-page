import {Link} from 'react-router-dom';
import React from 'react';

function Genero(props) {

	return (
		<div className='contenedor-pg'>
			<p className='nombre-pg'> {props.nombre} </p>
			<div>
				<Link to={'/generos/edit/'+props.id} id='button' >EDITAR</Link>
				<Link to={'/generos/delete/'+props.id+'/'+props.nombre} id='button' >BORRAR</Link>
			</div>
		</div>
		);
}

export default Genero;