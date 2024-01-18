import React from 'react';

function FilterBarComponent(){
    return (
        <div className="prueba1">
            <select className="selector" id="selector" name="ordenar">  
                <option value="">Ordenar</option>
                <option value="asc">Ascendente</option>
                <option value="desc">Descendente</option>
            </select>
            <select className="selector" id="selector1" name="plataforma">
                <option value="0">Selecciona una plataforma</option>
            </select>
            <select className="selector" id="selector2" name="genero">
                <option value="0">Selecciona un género</option>
            </select>
            <input id="buscador" type="text" name="nombre" placeholder="escriba nombre aqui..."></input>
            <button id="button"> FILTRAR </button>
        </div>
    );
}

export default FilterBarComponent;