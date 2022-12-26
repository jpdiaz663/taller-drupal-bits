
import { getData } from '../utils/endpoints';

class apiDataProvider {
  //get data user.
    async getUser(url) {
        return await getData(url);
    }
    
}

export {apiDataProvider};