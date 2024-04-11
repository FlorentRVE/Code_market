// ============================ Fonction ========================

//============ URL
const API_BASE_URL = "https://exemple.url";


//=========== Requete GET selon recherche
export const getData = async (searchTerms: string) => {
  return await fetch(API_BASE_URL + searchTerms).then((response) =>
    response.json()
  );
};

//===========Requete POST
let headersList = {
    Accept: "*/*",
    "Content-Type": "application/json",
};

export const postData = async (info: Object) => {
  await fetch(API_BASE_URL, {
    method: "POST",
    body: JSON.stringify(info),
    headers: headersList,
  })
  .then((res) => res.json())
  .then((data) => console.log(data));
};
