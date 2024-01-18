import {useParams , useNavigate} from "react-router-dom";
import React from 'react';
import axios from 'axios';
import HeaderComponent from '../../components/HeaderComponent';
import FooterComponent from '../../components/FooterComponent';
import NavBarComponent from '../../components/NavBarComponent';

function DeletePage(props) {
	const params = useParams();
    const id = params.id;
    const nombre = params.nombre;
    const navigate = useNavigate();

	const deleteEndpoint = async () => {
        try {
            const response = await axios.delete("http://localhost:8000/generos/"+id);
            //console.log(response.data);  
            if (response.status == 201) {
                alert(response.data);
                navigate("/generos");
            } else {
                alert(response.data);
                navigate("/generos");
            }  
        } catch (error) {
            console.log(error);
        }
    }

    function navigateToGenres(){
        alert("El genero "+nombre+" no se ha eliminado");
        window.location.href = "/generos";
      }

	return (
        <div>
            <HeaderComponent />
            <NavBarComponent />
                <div>
                    <p className='titulo-pages'> ELIMINAR GENERO </p>
                    <p className='parrafo-pages'> Esta seguro que desea eliminar el genero "{nombre}"?  
                    <button id="button-b" onClick={deleteEndpoint} > SI </button>
                    <button id="button-b" onClick={navigateToGenres} > NO </button>
                    </p>
                </div>
            <FooterComponent />
        </div>
		);
}

export default DeletePage;