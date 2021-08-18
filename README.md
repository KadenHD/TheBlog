# To do :
- passer les templates de base en index.twig au lieu de profile.twig pour profile
- créer des routes index dans chaques controllers = /admin/contact name="admin_contacts_index" pour pouvoir retourner dessus dans les autres fonctions au lieux d'un url
- changer le nom des fonctions en create update etc au lieu de createArticle etc
- changer name des routes ex : si /admin/contact/edition/{id} alors admin_contacts_update
- modifier nom des formulaires et appeler dans les twig
- move fonction des controller en fonction des routes ex (/article/etc...) => articleController
- move all form inside formtype and inside controller create form using the new formType
- changer les routes au besoins et modifier les boutons de twig si modifié
- mettre les forms dans des form.twig pour ensuite les includes là où il faut
- optimiser les fonctions crud
- let users delete their comments
- add delete button of comment and article on all page where we see them ?

# Links : 
- https://github.com/tvatry/adblangues
- https://youtu.be/_cgZheTv-FQ
