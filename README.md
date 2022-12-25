<p align="center">
  <h1 align="center">
    Indonesia Weather API <br>
  </h1>
</p>

<p align="center">
  source by <a href='https://data.bmkg.go.id/prakiraan-cuaca/'>data.bmkg.go.id</a>
</p>

- [x] Humidity
- [x] Max. Humidity
- [x] Min. Humidity
- [x] Temperature
- [x] Max. Temperature
- [x] Min. Temperature
- [x] Weather
- [x] Wind direction
- [x] Wind speed

## DEMO
<a href='https://api-cuaca-indo.up.railway.app/'>https://api-cuaca-indo.up.railway.app/</a>

## PROVINCE

 * Endpoint
    ``` 
    /api/v1/api/v1/province
    ```

 * Response
    ```json
    [
      {
          "id": 11,
          "nama": "Aceh"
      },
      {
          "id": 12,
          "nama": "Sumatera Utara"
      },
      {
          "id": 13,
          "nama": "Sumatera Barat"
      },

      // ...
    ```

## CITIY

 * Endpoint
    ``` 
    /api/v1/city?provId={province id}
    ```

 * Response
    ```json
    [
      {
          "id": 3201,
          "id_provinsi": "32",
          "nama": "Kabupaten Bogor"
      },
      {
          "id": 3202,
          "id_provinsi": "32",
          "nama": "Kabupaten Sukabumi"
      },
      {
          "id": 3203,
          "id_provinsi": "32",
          "nama": "Kabupaten Cianjur"
      },

      // ...
    ```

## WEATHER
  * Endpoint 
    ``` 
    /api/v1/weather?province={province name}&city={city name}
    ```
 * Response
    ```json
    {
        "timestamp": "2022-12-25 02:30:59",
        "province": "Jawa Barat",
        "city": "Kabupaten Cianjur",
        "district": {
            "Cianjur": {
                "now": {
                    "Humidity": {
                        "timestamp": "2022-12-27 18:00",
                        "value": "95%"
                    },
                    "Max humidity": {
                        "timestamp": "2022-12-27 12:00",
                        "value": "95%"
                    },
                    "Max temperature": {
                        "timestamp": "2022-12-27 12:00",
                        "value": {
                            "C": "29",
                            "F": "84.2"
                        }
                    },
                    "Min humidity": {
                        "timestamp": "2022-12-27 12:00",
                        "value": "65%"
                    },
                    "Min temperature": {
                        "timestamp": "2022-12-27 12:00",
                        "value": {
                            "C": "20",
                            "F": "68"
                        }
                    },
                    "Temperature": {
                        "timestamp": "2022-12-27 18:00",
                        "value": {
                            "C": "20",
                            "F": "68"
                        }
                    },
                    "Weather": {
                        "timestamp": "2022-12-27 18:00",
                        "value": {
                            "icon": "3",
                            "description": "Berawan \/ Mostly Cloudy"
                        }
                    },
                    "Wind direction": {
                        "timestamp": "2022-12-27 18:00",
                        "value": {
                            "deg": "247.5",
                            "CARD": "west-southwest",
                            "SEXA": "24730"
                        }
                    },
                    "Wind speed": {
                        "timestamp": "2022-12-27 18:00",
                        "value": {
                            "Kt": "5",
                            "MPH": "5.75389725",
                            "KPH": "9.26",
                            "MS": "2.57222222"
                        }
                    }
                },
                "three_days_ahead": {
                    "Humidity": [
                        {
                            "timestamp": "2022-12-25 00:00",
                            "value": "85%"
                        },
                        {
                            "timestamp": "2022-12-25 06:00",
                            "value": "75%"
                        },

                        // ...
                    ],
                    "Max humidity": [
                        {
                            "timestamp": "2022-12-25 12:00",
                            "value": "95%"
                        },

                        // ...
                    ],
                    "Max temperature": [
                        {
                            "timestamp": "2022-12-25 12:00",
                            "value": {
                                "C": "31",
                                "F": "87.8"
                            }
                        },

                        // ...
                    ],
                    "Min humidity": [
                        {
                            "timestamp": "2022-12-25 12:00",
                            "value": "75%"
                        },

                        // ...
                    ],
                    "Min temperature": [
                        {
                            "timestamp": "2022-12-25 12:00",
                            "value": {
                                "C": "19",
                                "F": "66.2"
                            }
                        },

                        // ...
                    ],
                    "Temperature": [
                        {
                            "timestamp": "2022-12-25 00:00",
                            "value": {
                                "C": "22",
                                "F": "71.6"
                            }
                        },
                        {
                            "timestamp": "2022-12-25 06:00",
                            "value": {
                                "C": "31",
                                "F": "87.8"
                            }
                        },

                        // ...
                    ],
                    "Weather": [
                        {
                            "timestamp": "2022-12-25 00:00",
                            "value": {
                                "icon": "60",
                                "description": "Hujan Ringan \/ Light Rain"
                            }
                        },
                        {
                            "timestamp": "2022-12-25 06:00",
                            "value": {
                                "icon": "60",
                                "description": "Hujan Ringan \/ Light Rain"
                            }
                        },

                        // ...
                    ],
                    "Wind direction": [
                        {
                            "timestamp": "2022-12-25 00:00",
                            "value": {
                                "deg": "270",
                                "CARD": "west",
                                "SEXA": "27000"
                            }
                        },
                        {
                            "timestamp": "2022-12-25 06:00",
                            "value": {
                                "deg": "270",
                                "CARD": "west",
                                "SEXA": "27000"
                            }
                        },

                        // ...
                    ],
                    "Wind speed": [
                        {
                            "timestamp": "2022-12-25 00:00",
                            "value": {
                                "Kt": "2",
                                "MPH": "2.3015589",
                                "KPH": "3.704",
                                "MS": "1.028888888"
                            }
                        },
                        {
                            "timestamp": "2022-12-25 06:00",
                            "value": {
                                "Kt": "5",
                                "MPH": "5.75389725",
                                "KPH": "9.26",
                                "MS": "2.57222222"
                            }
                        },

                        // ...
                    ]
                },
            },

            // ...
        }
    }
    ```