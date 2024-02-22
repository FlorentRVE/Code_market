// ============================ Fonction ========================

// ============ API ==========
const API_BASE_URL =
  "https://api.themoviedb.org/3/search/movie?api_key=26a145d058cf4d1b17cbf084ddebedec&language=fr-FR&query=";
const API_GENRE_URL =
  "https://api.themoviedb.org/3/genre/movie/list?api_key=26a145d058cf4d1b17cbf084ddebedec&language=fr-FR";

// Récupérer les films selon recherche
export const getData = async (searchTerms: string) => {
  return await fetch(API_BASE_URL + searchTerms).then((response) =>
    response.json()
  );
};

// Récupérer tous les genre
export const getGenre = async () => {
  return await fetch(API_GENRE_URL).then((response) => response.json());
};
