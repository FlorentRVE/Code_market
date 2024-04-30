    #[Route('/', name: 'app_home')]
    public function home()
    {
        if (in_array('ROLE_ADMIN', $this->getUser()->getRoles()) || in_array('ROLE_PLANNING', $this->getUser()->getRoles())) {

            return $this->redirectToRoute('app_roulement_index', [], Response::HTTP_SEE_OTHER);

        } else {

            return $this->redirectToRoute('app_roulement_user', [], Response::HTTP_SEE_OTHER);
        }
    }
