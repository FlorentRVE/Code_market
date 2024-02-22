//////////////////// Exemple de slice pour récupérer des données via API, avec reducer Search et Tri //////////////////////

import { PayloadAction, createSlice } from "@reduxjs/toolkit";
import type { RootState } from "../../app/store";
import * as api from "../../utils/api";

export interface MovieDataState {
  value: any;
}
let searchTerms: string = "a";
let data: any = await api.getData(searchTerms);

const initialState: MovieDataState = {
  value: data["results"],
};
// ============================

export const movieDataSlice = createSlice({
  name: "movieData",
  initialState,
  reducers: {
    search: (state, action: PayloadAction<string>) => {
      let searchTerms: string = action.payload;
      async function getData() {
        data = await api.getData(searchTerms);
      }
      getData();
      state.value = data["results"];
    },
    triASC: (state) => {
      state.value.sort(
        (a: { vote_average: number }, b: { vote_average: number }) =>
          a.vote_average - b.vote_average
      );
    },
    triDSC: (state) => {
      state.value.sort(
        (a: { vote_average: number }, b: { vote_average: number }) =>
          b.vote_average - a.vote_average
      );
    },
  },
});

export const { search, triASC, triDSC } = movieDataSlice.actions;
export default movieDataSlice.reducer;

export const selectMovieData = (state: RootState) => state.movieData.value;

