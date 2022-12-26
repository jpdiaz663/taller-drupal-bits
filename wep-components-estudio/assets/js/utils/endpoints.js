import axios from 'axios';

// api url
const base_url =
    "https://randomuser.me";

let instance

const getAxios = () => {
    if (!instance) {
        instance = axios.create({
            baseURL: base_url,
            headers: {
                Accept: 'application/json',
                // Authorization: `Bearer ${token}`
            }
        })
    }

    return instance
}


  
export const getData = async (url) =>  {
    return await getAxios().get(url, {
        timeout: 2000
    }).then(( resp ) => resp.data.results);
}
