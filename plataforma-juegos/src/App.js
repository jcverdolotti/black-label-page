import logo from './logo.svg';
import './App.css';
import { BrowserRouter, Route, Routes } from 'react-router-dom';

/*Page component*/
import DashboardPage from "./pages/dashboard/DashboardPage";
import GenreListPage from "./pages/generos/GenerosPage";
import PlatformListPage from "./pages/plataformas/PlataformasPage";
import GenreNewPage from "./pages/generos/NewPage";
import GenreEditPage from "./pages/generos/EditPage";
import GenreDeletePage from "./pages/generos/DeletePage";
import PlatformNewPage from "./pages/plataformas/NewPage";
import PlatformEditPage from "./pages/plataformas/EditPage";
import PlatformDeletePage from "./pages/plataformas/DeletePage";

function App() {
  return (
    <BrowserRouter>
    <Routes>
      <Route path={"/"} element={<DashboardPage />} />
      <Route path={"/generos"} element={<GenreListPage />} />
      <Route path={"/plataformas"} element={<PlatformListPage />} />
      <Route path={"/generos/new"} element={<GenreNewPage />} />
      <Route path={"/generos/edit/:id"} element={<GenreEditPage />} />
      <Route path={"/generos/delete/:id/:nombre"} element={<GenreDeletePage />} />
      <Route path={"/plataformas/new"} element={<PlatformNewPage />} />
      <Route path={"/plataformas/edit/:id"} element={<PlatformEditPage />} />
      <Route path={"/plataformas/delete/:id/:nombre"} element={<PlatformDeletePage />} />
    </Routes>
    </BrowserRouter>
  );
}

export default App;
