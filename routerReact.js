////////////////////// (1) Créer router //////////////////

import { createBrowserRouter } from "react-router-dom";
import HomePage from "../pages/homePage";
import MoviePage from "../pages/moviePage";

const router = createBrowserRouter([
  {
    path: "/",
    element: < HomePage />,
  },
  {
    path: "/movie/:id",
    element: < MoviePage />,
  },
]);

export default router;

/////////////// (2) Modifier App ////////////////////

import { RouterProvider } from "react-router-dom";
import router from "./utils/router";

function App() {
  return <RouterProvider router={router} />;
}

export default App;

