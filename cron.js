var mysql = require('mysql')
var md5 = require("md5")
var moment = require('moment')
require('dotenv').config({ path: '/home/stock/sblara/.env' })

// var eodTable = 'data_banks_eods_2019_feb_12'
// var intradayTable = 'data_banks_intradays_3_dec_2018'
// var instrumentTable = 'instruments_test'
// var marketTable = 'markets_test'
// var tradesTable = 'trades_test'

var eodTable = 'data_banks_eods'
var intradayTable = 'data_banks_intradays'
var instrumentTable = 'instruments'
var marketTable = 'markets'
var tradesTable = 'trades'

var store = {}
    store.sbEod = []
    store.sbIntraday = []
    store.volumeData = []

var sb;
var dse;

function refreshdse() {
       dse = mysql.createConnection({
      host: "202.84.32.15",
      user:  "stockbangladesh",
      password: "123456",
      database: "mdsdata"
    });
 
    dse.on('error', (err)=>{
      console.log("refreshing dse")
      refreshdse()
      cron()
    })       

}

function refreshSb() {

     sb = mysql.createConnection({
      host: "localhost",
      user:  process.env.DB_USERNAME,
      password:  process.env.DB_PASSWORD,
      database: process.env.DB_DATABASE,
      socketPath:"/var/lib/mysql/mysql.sock",
    });

 
  sb.on('error', (err)=>{
    console.log(err)
    console.log("refreshing sb")
    refreshSb()
    cron()
  })  

}

function refreshCon() {
  refreshSb()
  refreshdse()
}

function updateTrade(batch) {
      dse.query("select * from TRD", (err, result , f)=>{
        var q = "INSERT INTO "+tradesTable+" (market_id, TRD_SNO, TRD_TOTAL_TRADES, TRD_TOTAL_VOLUME, TRD_TOTAL_VALUE, TRD_LM_DATE_TIME, trade_time, trade_date, batch) VALUES "
       var length = result.length
        result.forEach((v, i)=>{

           var dt = moment(v.TRD_LM_DATE_TIME)
           q+= `('${store.market.id}', '${v.TRD_SNO}', '${v.TRD_TOTAL_TRADES}',  '${v.TRD_TOTAL_VOLUME}',  '${v.TRD_TOTAL_VALUE}',  '${dt.format("YYYY-MM-DD HH:mm:ss")}', '${dt.format("HH:mm")}', '${dt.format("YYYY-MM-DD")}', '${batch}')`
                     if(length != (i+1)){
                        q += ","
                     }
        })

        sb.query(q, (err, res, f)=>{
          console.log("successfull")
                setTimeout(function() {
                    cron()
                 }, 5000);          
        })

      })


}

function updateIntraday() {
    //update intraday
    // update market table with batch and total trade values
    // update instrument table batch
    var batch = store.data_bank_intraday_batch
    if(store.batchTime != batch+" "+ moment().format("HH:mm")){
      batch++
      store.batchTime = batch+" "+ moment().format("HH:mm");
    }

    sb.query(`select ${intradayTable}.*, instruments.instrument_code, instruments.id as instrument_id from instruments left join ${intradayTable} on instruments.id = ${intradayTable}.instrument_id  and batch = '${batch}'`, (err, dseintra, f)=>{
      dseintra.forEach((value, index)=>{
          store.sbIntraday[value.instrument_code] = value
      })
      var query = "INSERT INTO "+intradayTable+" (id, market_id, instrument_id, quote_bases,  open_price, pub_last_traded_price, spot_last_traded_price, high_price, low_price, close_price, yday_close_price, total_trades, total_volume, new_volume, total_value, public_total_trades, public_total_volume, public_total_value, spot_total_trades, spot_total_volume, spot_total_value, lm_date_time, trade_time, trade_date, batch) VALUES "
      var instrument_ids = "( ";

      store.dsedata.forEach((v, i)=>{
                    if(v.MKISTAT_TOTAL_TRADES < 1){
                      return
                    }

                    var id = 'NULL';
                    if(store.sbIntraday[v.MKISTAT_INSTRUMENT_CODE] != null){
                      ins = store.sbIntraday[v.MKISTAT_INSTRUMENT_CODE]
                      id = ins.id;

                      instrument_ids += ins.instrument_id;
                    }

                    if(id == null){
                      id = 'NULL';
                    }

                    var date = ''

                   var  ltp = v.MKISTAT_CLOSE_PRICE != 0 ? v.MKISTAT_CLOSE_PRICE : (v.MKISTAT_PUB_LAST_TRADED_PRICE != 0 ? v.MKISTAT_PUB_LAST_TRADED_PRICE : v.MKISTAT_SPOT_LAST_TRADED_PRICE);
                    var new_volume = 0;
                    if(ins.total_volume == null){
                      ins.total_volume = store.volumeData[v.MKISTAT_INSTRUMENT_CODE]
                    }
                    if(v.MKISTAT_TOTAL_VOLUME - ins.total_volume > 0){
                      new_volume = v.MKISTAT_TOTAL_VOLUME - ins.total_volume
                    }

                    store.volumeData[v.MKISTAT_INSTRUMENT_CODE] = v.MKISTAT_TOTAL_VOLUME
                    var length = store.dsedata.length

                     query += ` (${id}, '${store.market.id}', '${ins.instrument_id}', '${v.MKISTAT_QUOTE_BASES}', '${v.MKISTAT_OPEN_PRICE}', '${v.MKISTAT_PUB_LAST_TRADED_PRICE}', '${v.MKISTAT_SPOT_LAST_TRADED_PRICE}',  '${v.MKISTAT_HIGH_PRICE}',   '${v.MKISTAT_LOW_PRICE}', '${ltp}', '${v.MKISTAT_YDAY_CLOSE_PRICE}', '${v.MKISTAT_TOTAL_TRADES}', '${v.MKISTAT_TOTAL_VOLUME}',  '${new_volume}', '${v.MKISTAT_TOTAL_VALUE}', '${v.MKISTAT_PUBLIC_TOTAL_TRADES}',  '${v.MKISTAT_PUBLIC_TOTAL_VOLUME}', '${v.MKISTAT_PUBLIC_TOTAL_VALUE}',   '${v.MKISTAT_SPOT_TOTAL_TRADES}',   '${v.MKISTAT_SPOT_TOTAL_VOLUME}',   '${v.MKISTAT_SPOT_TOTAL_VALUE}',   '${moment(v.MKISTAT_LM_DATE_TIME).format("YYYY-MM-DD HH:mm:ss")}',  '${moment(v.MKISTAT_LM_DATE_TIME).format("HH:mm")}',  '${moment(v.MKISTAT_LM_DATE_TIME).format("YYYY-MM-DD")}', '${batch}' )`
                     if(length != (i+1)){
                        query += ","
                       instrument_ids += ", ";
                     }

      })

      instrument_ids += ")";
     query += " ON DUPLICATE KEY UPDATE market_id = VALUES(market_id), instrument_id = VALUES(instrument_id), quote_bases = VALUES(quote_bases),  open_price = VALUES(open_price), pub_last_traded_price = VALUES(pub_last_traded_price), spot_last_traded_price = VALUES(spot_last_traded_price), high_price = VALUES(high_price), low_price = VALUES(low_price), close_price = VALUES(close_price), yday_close_price = VALUES(yday_close_price), total_trades = VALUES(total_trades), total_volume = VALUES(total_volume), new_volume = VALUES(new_volume), total_value = VALUES(total_value), public_total_trades = VALUES(public_total_trades), public_total_volume = VALUES(public_total_volume), public_total_value = VALUES(public_total_value), spot_total_trades = VALUES(spot_total_trades), spot_total_volume = VALUES(spot_total_volume), spot_total_value = VALUES(spot_total_value), lm_date_time = VALUES(lm_date_time), trade_time = VALUES(trade_time), trade_date = VALUES(trade_date), batch = VALUES(batch) "
          
     sb.query(query, (err, res)=>{
        // console.log(res)
        //update instrument table bbatch
        sb.query("update "+instrumentTable+" set batch_id = "+batch+" where id in "+instrument_ids, (err, res)=>{
            sb.query("update "+marketTable+" set data_bank_intraday_batch = "+ batch+", batch_total_trades = "+store.totalTrades+" where id = "+store.market.id, (err, res)=>{
              updateTrade(batch)
            })
        })
     })

    })



}

function fetchData() {

          var date = moment().format('YYYY-MM-DD')
          query = "select SUM(MKISTAT_TOTAL_TRADES) as total_trades,SUM(MKISTAT_TOTAL_VALUE) as total_value,SUM(MKISTAT_TOTAL_VOLUME) as total_volume,MAX(MKISTAT_LM_DATE_TIME) as MKISTAT_LM_DATE_TIME from MKISTAT";

  
          dse.query(query, (err, result, fields)=> {
              if(err){
                console.log("error occured");
              }
            result = result[0]

            if(store.totalTrades < result.total_trades){     //production line
            // if(true){ //line for debug
              //data changed get the data
              store.totalTrades = result.total_trades

              //debeug codes
              // dse tables are =>   'IDX' ,  'MAN', 'MKISTAT', 'TRD'  
                          //           {
                          // MKISTAT_INSTRUMENT_CODE: 'T15Y0323',
                          // MKISTAT_INSTRUMENT_NUMBER: 7197,
                          // MKISTAT_QUOTE_BASES: 'A-TB',
                          // MKISTAT_OPEN_PRICE: 0,
                          // MKISTAT_PUB_LAST_TRADED_PRICE: 0,
                          // MKISTAT_SPOT_LAST_TRADED_PRICE: 0,
                          // MKISTAT_HIGH_PRICE: 0,
                          // MKISTAT_LOW_PRICE: 0,
                          // MKISTAT_CLOSE_PRICE: 0,
                          // MKISTAT_YDAY_CLOSE_PRICE: 100000,
                          // MKISTAT_TOTAL_TRADES: 0,
                          // MKISTAT_TOTAL_VOLUME: 0,
                          // MKISTAT_TOTAL_VALUE: 0,
                          // MKISTAT_PUBLIC_TOTAL_TRADES: 0,
                          // MKISTAT_PUBLIC_TOTAL_VOLUME: 0,
                          // MKISTAT_PUBLIC_TOTAL_VALUE: 0,
                          // MKISTAT_SPOT_TOTAL_TRADES: 0,
                          // MKISTAT_SPOT_TOTAL_VOLUME: 0,
                          // MKISTAT_SPOT_TOTAL_VALUE: 0,
                          // MKISTAT_LM_DATE_TIME: '2019-02-12 08:46:16' }
              dse.query("select * from MKISTAT ", (err, dsedata, field)=>{

                  store.dsedata = dsedata;
                sb.query(`select ${eodTable}.*, instruments.instrument_code, instruments.id as instrument_id from instruments left join ${eodTable} on instruments.id = ${eodTable}.instrument_id  and date = '${moment().format('YYYY-MM-DD')}'`, (err, sbdata) => {
                 
                  // create the key by array for previous dse eod database
                  store.sbEod = [];
                  sbdata.forEach((value, index)=>{
                    store.sbEod[value.instrument_code] = value
                  })

                  // insert or update eod => create/generate the query string
                  query = "INSERT INTO "+eodTable+" (id, market_id, instrument_id, open, high, low, close, volume, trade, tradevalues,  date) VALUES "
                 
                var length = dsedata.length
                 dsedata.forEach((v, i)=>{
                    if(v.MKISTAT_TOTAL_TRADES < 1){
                      return
                    }
                    var id = 'NULL';
                    if(store.sbEod[v.MKISTAT_INSTRUMENT_CODE] != null){
                      ins = store.sbEod[v.MKISTAT_INSTRUMENT_CODE]
                      id = ins.id;
                    }
                    if(id == null){
                      id = 'NULL';
                    }

                    var  ltp = v.MKISTAT_CLOSE_PRICE != 0 ? v.MKISTAT_CLOSE_PRICE : (v.MKISTAT_PUB_LAST_TRADED_PRICE != 0 ? v.MKISTAT_PUB_LAST_TRADED_PRICE : v.MKISTAT_SPOT_LAST_TRADED_PRICE);
                  
                     query += ` (${id}, '${store.market.id}', '${ins.instrument_id}', '${v.MKISTAT_OPEN_PRICE}', '${v.MKISTAT_HIGH_PRICE}', '${v.MKISTAT_LOW_PRICE}', '${ltp}', '${v.MKISTAT_TOTAL_VOLUME}', '${v.MKISTAT_TOTAL_TRADES}', '${v.MKISTAT_TOTAL_VALUE}',  '${date}')`
                     if(length != (i+1)){
                        query += ","
                     }
                 })

                 

                  query += " ON DUPLICATE KEY UPDATE market_id = VALUES(market_id), instrument_id = VALUES(instrument_id),  open = VALUES(open), high = VALUES(high) , low = VALUES(low) , close = VALUES(close)  , volume = VALUES(volume)  , trade = VALUES(trade)  , tradevalues = VALUES(tradevalues)  , date = VALUES(date), updated = now() "
          

                    // console.log(store.market)
                  sb.query(query, (e, r, f)=>{
                    // console.log(e)
                    updateIntraday()
                    // console.log(f)
                  })

                })
              })
              //debug codes

            }else{
              console.log("data not changed")

            setTimeout(function() {cron()}, 2000);
            }

            // setTimeout(function() {cron()}, 5000);
          })
    
}





function cron() {

      sb.query(`SELECT * FROM ${marketTable} WHERE trade_date = '${moment().format("YYYY-MM-DD")}'`, (err, result, fields)=>{
        if(err){
          console.log('refreshing connections')
          console.log(err)
          process.exit()
          refreshCon()
          cron()
          return;
        }
        if(result.length == 0){
           process.exit()
        }
      	result = result[0]
        var market = result;

        store.market = market;

        if(!store.totalTrades){
          store.totalTrades = result.batch_total_trades;
        }

      	var start  = moment(result.market_started, "HH:mm:ss");
      	var end  = moment(result.market_closed, "HH:mm:ss");
        store.end = end;
      	//
      	if(moment().isBefore(end) && moment().isAfter(start)){ //production line
        // if(true || moment().isBefore(end) && moment().isAfter(start)){   // debug line
      		// market is open open
      		// console.log("market is open")
          //get the batch and proced to fetchData
          if(result.data_bank_intraday_batch == 0){
            sb.query('select MAX(data_bank_intraday_batch) as data_bank_intraday_batch from '+marketTable, (err, result, fields)=>{
                      if(err){
                        console.log('refreshing connections')
                        refreshCon()
                        cron()
                        return;
                      }
              store.data_bank_intraday_batch = result[0].data_bank_intraday_batch
               fetchData()
            })
          }else{
            store.data_bank_intraday_batch = result.data_bank_intraday_batch
            fetchData()
          }
      	}else{
          console.log("market is not open")
          if(moment().isAfter(store.end)){
            process.exit()
          }
          setTimeout(function() {
            cron()
        }, 5000);
        }
      })
  }

refreshCon()
cron()
// dse.connect(function(err) {
//   if (err) throw err;
//   console.log("Connected dse!");
// });




// dse.query("select * from MKISTAT ORDER BY MKISTAT_LM_DATE_TIME DESC LIMIT 0 , 600", function (err, result, fields) {
// 	console.log(result.length)

// console.log(md5(result))
// })

