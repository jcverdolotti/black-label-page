import React, { useState, useEffect } from 'react';
import axios from 'axios';
import HeaderComponent from '../../components/HeaderComponent';
import FooterComponent from '../../components/FooterComponent';
import NavBarComponent from '../../components/NavBarComponent';
import Juego from './Juego';

const DashboardPage = () => {
  const [juegos, setJuegos] = useState([]);
  const [generos, setGeneros] = useState([]);
  const [plataformas, setPlataformas] = useState([]);
  const [form, setForm] = useState({
    nombre: "",
    genero: 0,
    plataforma: 0,
    orden: ""
  });




  useEffect(() => {
    const fetchData = async () => {
      try {
        const responseG = await axios.get(`http://localhost:8000/generos`);
        setGeneros(responseG.data);
        const responseP = await axios.get(`http://localhost:8000/plataformas`);
        setPlataformas(responseP.data);
        const response = await axios.get(`http://localhost:8000/juegos`);
        // que lo llame normal, sin condiciones abajo, y despues en el filterEndpoint, tiene que hacer el onchange de 1 solo

        setJuegos(response.data);
      } catch (error) {
        console.error(error);
      }
    }

    fetchData();
  }, []);

  const setFormValue = (property, value) => {
    setForm(prevForm => ({
      ...prevForm,
      [property]: value
    }))
    console.log(`${property} value updated to: ${value}`)
  }

  const filterEndpoint = async () => {
    try {
      const { nombre, genero, plataforma, orden } = form;
      let endpoint = "";

      if (genero != 0) {
        endpoint = "&genero="+genero;
      }
      if (plataforma != 0) {
        endpoint = endpoint + "&plataforma="+plataforma;
      } 
      const response = await axios.get(`http://localhost:8000/juegos?nombre=${nombre}&orden=${orden}${endpoint}`);
      setJuegos(response.data);
    } catch (error) {
      console.log(error);
    }
  }

  return (
    <div>
      <HeaderComponent />
      <NavBarComponent />
      <div className="prueba1">
        <select className="selector" id="selector" name="ordenar" onChange={e => setFormValue("orden", e.target.value)}>
          <option value="">Ordenar</option>
          <option value="asc">Ascendente</option>
          <option value="desc">Descendente</option>
        </select>
        <select className="selector" id="selector1" name="plataforma" onChange={e => setFormValue("plataforma", e.target.value)}>
          <option value="0">Selecciona una plataforma</option>
          {plataformas.map(plataforma => <option key={plataforma.id} value={plataforma.id}> {plataforma.nombre}</option>)}
        </select>
        <select className="selector" id="selector2" name="genero" onChange={e => setFormValue("genero", e.target.value)}>
          <option value="0">Selecciona un género</option>
          {generos.map(genero => <option key={genero.id} value={genero.id}>{genero.nombre}</option>)}
        </select>
        <input id="buscador" type="text" name="nombre" onChange={e => setFormValue("nombre", e.target.value)} placeholder="escriba nombre aqui..."></input>
        <button id="button" onClick={filterEndpoint}> FILTRAR </button>
      </div>

      {Array.isArray(juegos) && juegos.length > 0 ?
        juegos.map(juego => (
          <Juego
            key={juego.id}
            nombre={juego.nombre}
            id={juego.id}
            imagen={juego.imagen}
            descripcion={juego.descripcion}
            url={juego.url}
            genero={juego.nombre_genero}
            plataforma={juego.nombre_plataforma}
          />
        )) :
        null
      }
      <FooterComponent />
    </div>

  );
};

export default DashboardPage;