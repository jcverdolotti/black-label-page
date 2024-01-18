import {Link} from 'react-router-dom';
import React from 'react';

function Juego(props) {

	return (
		<div className='contenedor-juego'>
			<img className='imagen-juego' src={`data:image/jpeg;base64,${props.imagen}`}/>
			<div className='texto-juego'>
				<h2 className='nombre-juego'> {props.nombre} </h2>
				<p className='genero-plataforma-juego'> {props.plataforma} - {props.genero} </p>
				<p className='descripcion-juego'> {props.descripcion} </p>
				<a className='url-juego' href={props.url}>Sitio Web</a>
			</div>
		</div>
		);
}

export default Juego;